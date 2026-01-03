<?php

namespace App\Services\Executive\Discount;

use App\Models\ListDiscount;
use App\Http\Resources\DefaultResource;

class SaveClass
{
    public function update($request){
        $data = ListDiscount::with('based','type','subtype')->where('id',$request->id)->first();
        $data->update($request->all());

        return [
            'data' => new DefaultResource($data),
            'message' => 'Discount update was successful!', 
            'info' => "You've successfully updated the selected discount."
        ];
    }
}
