<?php

namespace App\Services\Executive\Reference;

use App\Models\ListPosition;

class PositionClass
{
    public function lists(){
        $data = ListPosition::with('salary')->get();
        return $data;
    }

    public function update($request){
        $data = ListPosition::find($request->id);
        $data->name = $request->name;
        $data->short = $request->short;
        $data->salary_id = $request->salary_id;
        $data->is_regular = $request->is_regular;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
