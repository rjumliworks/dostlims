<?php

namespace App\Services\Executive\Reference;

use App\Models\ListDeduction;

class DeductionClass
{
    public function lists(){
        $data = ListDeduction::all();
        return $data;
    }

    public function update($request){
        $data = ListDeduction::find($request->id);
        $data->name = $request->name;
        $data->subtype = $request->subtype;
        $data->is_regular = $request->is_regular;
        $data->is_contribution = $request->is_contribution;
        $data->is_loan = $request->is_loan;
        $data->is_enrollable = $request->is_enrollable;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
