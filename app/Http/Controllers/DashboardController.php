<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        if(!\Auth::check()){
            return inertia('Auth/Login');
        }else{
            $user = \Auth::user();
            if($user->must_change) {
                return inertia('Auth/Activation');
            }
            return inertia('Modules/Dashboard/Index');
        }
    }
}
