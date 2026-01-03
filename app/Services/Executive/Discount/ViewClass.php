<?php

namespace App\Services\Executive\Discount;

use App\Models\ListDiscount;
use App\Http\Resources\DefaultResource;

class ViewClass
{
    public function list($request){
        $data = ListDiscount::with('based','type','subtype')->paginate($request->count);
        return DefaultResource::collection($data);
    }
}
