<?php

namespace App\Services\Executive\Reference;

use App\Models\ListLeave;

class LeaveClass
{
    public function lists(){
        $data = ListLeave::all();
        return $data;
    }

    public function update($request){
        $data = ListLeave::find($request->id);
        $data->name = $request->name;
        $data->citation = $request->citation;
        $data->sex = $request->sex;
        $data->is_convertible = $request->is_convertible;
        $data->is_regular = $request->is_regular;
        $data->is_after = $request->is_after;
        $data->is_requested = $request->is_requested;
        $data->carry_over = $request->carry_over;
        $data->requires_balance = $request->requires_balance;
        $data->renewal_period = $request->renewal_period;
        $data->max_days = $request->max_days;
        $data->accrual_rate = $request->accrual_rate;
        $data->is_active = $request->is_active;
        $data->save();
        
        return [
            'data' => $data,
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }
}
