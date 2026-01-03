<?php

namespace App\Services\Executive\Reference;

use App\Models\ListStatus;

class StatusClass
{
    public function lists(){
        $data = ListStatus::all();
        return $data;
    }

    public function update($request){
        $data = ListStatus::find($request->id);
        $data->name = $request->name;
        $data->classification = $request->classification;
        $data->type = $request->type;
        $data->color = $request->color;
        $data->bg = $request->bg;
        $data->icon = $request->icon;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
