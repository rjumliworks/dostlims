<?php

namespace App\Services\Executive\Facility;

use Hashids\Hashids;
use App\Models\Facility;
use App\Http\Resources\Executive\Facility\ListResource;
use App\Http\Resources\Executive\Facility\ViewResource;

class ViewClass
{
    public function list($request){
        $data = Facility::with('region','province','municipality','barangay','laboratories')->paginate($request->count);
        return ListResource::collection($data);
    }

    public function facility($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);

        $data = new ViewResource(
            Facility::query()
            ->with('region','province','municipality','barangay','laboratories')
            ->where('id',$id[0])->first()
        );
        return $data;
    }

}
