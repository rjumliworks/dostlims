<?php

namespace App\Services\Executive\Reference;

use App\Models\ListUnit;

class UnitClass
{
    public function lists(){
        $data = ListUnit::with('division')->get();
        return $data;
    }

    public function update($request){
        $data = ListUnit::find($request->id);
        $data->name = $request->name;
        $data->short = $request->short;
        $data->division_id = $request->division_id;
        $data->is_active = $request->is_active;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
