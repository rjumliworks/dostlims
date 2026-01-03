<?php

namespace App\Services\Executive\Reference;

use App\Models\ListSalary;

class SalaryClass
{
    public function lists(){
        $data = ListSalary::all();
        return $data;
    }

    public function update($request){
        $data = ListSalary::find($request->id);
        $data->grade = $request->grade;
        $data->amount = $request->amount;
        $data->is_regular = $request->is_regular;
        $data->year = $request->year;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
