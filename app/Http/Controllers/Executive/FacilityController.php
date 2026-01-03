<?php

namespace App\Http\Controllers\Executive;

use App\Traits\HandlesTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropdownClass;
use App\Services\Executive\Facility\SaveClass;
use App\Services\Executive\Facility\ViewClass;

class FacilityController extends Controller
{
    use HandlesTransaction;

    protected ViewClass $view;
    protected SaveClass $save;
    protected DropdownClass $dropdown;

    public function __construct(DropdownClass $dropdown, SaveClass $save, ViewClass $view){
        $this->dropdown = $dropdown;
        $this->view = $view;
        $this->save = $save;
    }

    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->view->list($request);
            break;
            default:
            return inertia('Executive/Facilities/Index',[
                'dropdowns' => [
                    'laboratories' => $this->dropdown->laboratories(),
                    'regions' => $this->dropdown->regions(),
                ]
            ]); 
        }   
    }

    public function store(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'facility':
                    return $this->save->facility($request);
                break;
                case 'laboratory':
                    return $this->save->laboratory($request);
                break;
            }
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function show($code){
        return inertia('Executive/Facilities/View',[
            'facility_data' => $this->view->facility($code),
            'dropdowns' => [
               'roles' => $this->dropdown->roles()
            ],
        ]);
    }
}
