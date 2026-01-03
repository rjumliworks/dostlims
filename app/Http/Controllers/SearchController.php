<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DropdownClass;

class SearchController extends Controller
{
    protected $dropdown;

    public function __construct(
            DropdownClass $dropdown
        ){
        $this->dropdown = $dropdown;
    }

    public function search(Request $request){
        $option = $request->option;
        switch($option){
            case 'provinces':
                return $this->dropdown->provinces($request->code);
            break;
            case 'municipalities':
                return $this->dropdown->municipalities($request->code);
            break;
            case 'barangays':
                return $this->dropdown->barangays($request->code);
            break;
            case 'units':
                return $this->dropdown->units($request->code);
            break;
            case 'users':
                return $this->dropdown->users($request->keyword,$request->is_regular);
            break;
            case 'vehicles':
                return $this->dropdown->vehicles($request->keyword);
            break;
            case 'schools':
                return $this->dropdown->schools($request->keyword);
            break;
            case 'courses':
                return $this->dropdown->courses($request->keyword);
            break;
        }
    }
}
