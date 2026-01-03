<?php

namespace App\Services\Executive\Users;

use Hashids\Hashids;
use App\Models\UserFace;
use App\Models\UserFolder;
use App\Models\UserFolderFile;
use App\Http\Resources\DefaultResource;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition\RekognitionClient;
use App\Http\Resources\Executive\FileResource;

class RekognitionClass
{
    public function fetch($request)
    {
        $hashids = new Hashids('krad', 10);
        $id = $hashids->decode($request->code)[0];

        $data = UserFolderFile::whereHas('folder', function ($query) use ($id) {
            $query->where('name', 'Reference')
                ->where('user_id', $id);
        })->get();

        // Add signed URL to each file
        $data->transform(function ($file) {
            $file->signed_url = Storage::disk('s3')->temporaryUrl(
                $file->path,            // must be relative key, e.g. "oneportal/69154a7b3fffd.png"
                now()->addMinutes(5)    // expiration
            );
            return $file; // important!
        });

        return DefaultResource::collection($data);
    }

    public function store($request){
        $file = $request->file('file');
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($request->id);

        $folder = UserFolder::firstOrCreate(
            ['user_id' => $request->id, 'name' => 'Reference']
        );
        
        $folder_id = $folder->id;
 
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $s3Path = $file->storeAs('oneportal/reference', $filename, 's3');

        $folderFile = UserFolderFile::create([
            'name' => $file->getClientOriginalName(),
            'path' => $s3Path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'status' => 'processing',
            'type_id' => 1,
            'folder_id' => $folder_id
        ]);

        try {
            $rekognition = new RekognitionClient([
                'version' => 'latest',
                'region'      => config('services.rekognition.region'),
                'credentials' => [
                    'key'    => config('services.rekognition.key'),
                    'secret' => config('services.rekognition.secret'),
                ],
            ]);

            $result = $rekognition->indexFaces([
                'CollectionId' => config('services.rekognition.collection_id'),
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config('services.rekognition.bucket'),
                        'Name' => $s3Path,
                    ],
                ],
                'ExternalImageId' => (string) $request->id, 
                'DetectionAttributes' => ['DEFAULT'],
            ]);
            foreach ($result['FaceRecords'] as $record) {
                UserFace::create([
                    'user_id' => $request->id,
                    'file_id' => $folderFile->id,
                    'face_id' => $record['Face']['FaceId'],
                    'image_id' => $record['Face']['ImageId'],
                    'status' => 'active',
                ]);
            }
            $folderFile->update(['status' => 'completed', 'face_id']);
        } catch (\Exception $e) {
            \Log::error('Rekognition failed: '.$e->getMessage());
        }

        // UploaderJob::dispatch($folderFile);
        return [
            'data' => new FileResource($folderFile),
            'message' => 'File uploaded successfully!',
            'info' => "Your file has been uploaded and is now available."
        ];
    }

    public function delete($request){
        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region'      => config('services.rekognition.region'),
            'credentials' => [
                'key'    => config('services.rekognition.key'),
                'secret' => config('services.rekognition.secret'),
            ],
        ]);
        $file = UserFolderFile::where('id',$request->id)->first();

        $faces = UserFace::where('file_id', $request->id)->get();
        foreach ($faces as $face) {
            $rekognition->deleteFaces([
                'CollectionId' => config('services.rekognition.collection_id'),
                'FaceIds' => [$face->face_id],
            ]);
        }
        Storage::disk('s3')->delete($file->path);
        UserFolderFile::where('id',$file->id)->delete();

        return [
            'data' => [],
            'message' => 'File deleted successfully!',
            'info' => "Your file has been deleted and is now available."
        ];
    }

}
