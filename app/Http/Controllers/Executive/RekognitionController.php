<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;

class RekognitionController extends Controller
{   
    public function test(){
        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region'      => config('services.rekognition.region'),
                'credentials' => [
                    'key'    => config('services.rekognition.key'),
                    'secret' => config('services.rekognition.secret'),
                ],
        ]);
        try {
            $result = $rekognition->listCollections();
            $resultArray = $result->toArray();

            return response()->json($resultArray);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function check(){
        $sts = new \Aws\Sts\StsClient([
            'version' => 'latest',
            'region' => 'ap-southeast-1',
            'credentials' => [
                'key' => config('services.rekognition.key'),
                'secret' => config('services.rekognition.secret'),
            ],
        ]);

        $identity = $sts->getCallerIdentity();
        dd($identity);
    }

    public function create(){
        try {
            $rekognition = new RekognitionClient([
                'version' => 'latest',
                'region' => 'ap-southeast-1',
                'credentials' => [
                    'key' => config('services.rekognition.key'),
                    'secret' => config('services.rekognition.secret'),
                ],
            ]);

            $result = $rekognition->createCollection([
                'CollectionId' => 'dost9-users',
            ]);

            return response()->json([
                'message' => 'Collection created successfully!',
                'result' => $result,
            ]);
        } catch (\Aws\Exception\AwsException $e) {
            return response()->json([
                'error' => $e->getAwsErrorMessage(),
                'type'  => $e->getAwsErrorCode(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(){
        try {
            $rekognition = new RekognitionClient([
                'version' => 'latest',
                'region' => 'ap-southeast-1',
                'credentials' => [
                    'key' => config('services.rekognition.key'),
                    'secret' => config('services.rekognition.secret'),
                ],
            ]);

            $collectionId = 'dost9-users';

            // 1. Get all faces
            $faces = $rekognition->listFaces([
                'CollectionId' => $collectionId,
                'MaxResults' => 1000,
            ]);

            if (!empty($faces['Faces'])) {
                $faceIds = array_column($faces['Faces'], 'FaceId');

                // 2. Delete all faces
                $rekognition->deleteFaces([
                    'CollectionId' => $collectionId,
                    'FaceIds' => $faceIds,
                ]);
            }

            return response()->json([
                'message' => 'All faces deleted successfully!',
            ]);

        } catch (\Aws\Exception\AwsException $e) {
            return response()->json([
                'error' => $e->getAwsErrorMessage(),
                'type'  => $e->getAwsErrorCode(),
            ], 500);
        }
    }

    public function search(){
        $rekognition = new RekognitionClient([
            'version' => 'latest',
            'region' => 'ap-southeast-1',
            'credentials' => [
                'key' => config('services.rekognition.key'),
                'secret' => config('services.rekognition.secret'),
            ],
        ]);

        $result = $rekognition->searchFacesByImage([
            'CollectionId' => 'dost9-users',
            'Image' => [
                'S3Object' => [
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                    'Name'   => 'oneportal/reference/692e69d3d9548.jpg',
                ],
            ],
            'FaceMatchThreshold' => 90,
            'MaxFaces' => 1,
        ]);

        return $result;
    }
}
