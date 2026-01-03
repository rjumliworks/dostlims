<?php

namespace App\Services\Executive\Facility;

use App\Models\Facility;

class SaveClass
{
    public function facility($request){
        $data = Facility::create($request->all());
        return [
            'data' => $data,
            'message' => 'Facility added was successful!', 
            'info' => "You've successfully added discount."
        ];
    }

    public function laboratory($request){

    }
}
