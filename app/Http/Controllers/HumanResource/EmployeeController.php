<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropdownClass;
use App\Traits\HandlesTransaction;
use App\Http\Requests\HumanResource\EmployeeRequest;
use App\Services\HumanResource\Employee\SaveClass;
use App\Services\HumanResource\Employee\ViewClass;
use App\Services\HumanResource\Employee\UpdateClass;

class EmployeeController extends Controller
{
    use HandlesTransaction;

    public $view, $save, $update, $dropdown;

    public function __construct(SaveClass $save, ViewClass $view, UpdateClass $update, DropdownClass $dropdown){
        $this->view = $view;
        $this->save = $save;
        $this->update = $update;
        $this->dropdown = $dropdown;
    }

    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->view->list($request);
            break;
            default:
            return inertia('Modules/HumanResource/Employees/Index',[
                'dropdowns' => [
                    'sexes' => $this->dropdown->datas('Sex'),
                    'suffixes' => $this->dropdown->datas('Suffix'),
                    'bloods' => $this->dropdown->datas('Blood Type'),
                    'religions' => $this->dropdown->datas('Religion'),
                    'maritals' => $this->dropdown->datas('Marital Status'),
                    'divisions' => $this->dropdown->dropdowns('Division'),
                    'stations' => $this->dropdown->stations(),
                    'positions' => $this->dropdown->positions(),
                    'salaries' => $this->dropdown->salaries(),
                    'statuses' => $this->dropdown->statuses('Status'),
                    'employment_statuses' => $this->dropdown->datas('Employment Status')
                ],
                'counts' => $this->view->counts()
            ]); 
        }   
    }

    public function store(EmployeeRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'employee':
                    return $this->save->store($request);
                break;
                case 'credential':
                    return $this->save->credential($request);
                break;
                case 'academic':
                    return $this->save->academic($request);
                break;
                case 'deduction':
                    return $this->save->deduction($request);
                break;
                case 'contract':
                    return $this->save->contract($request);
                break;
                case 'listacademic':
                    return $this->save->listacademic($request);
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

    public function update(EmployeeRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'employee':
                    return $this->save->update($request);
                break;
                case 'background':
                    return $this->update->background($request);
                break;
                case 'account':
                    return $this->update->account($request);
                break;
                case 'salary':
                    return $this->update->salary($request);
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
        return inertia('Modules/HumanResource/Employees/View',[
            'employee_data' => $this->view->view($code),
            'dropdowns' => [
                'eligibilities' => $this->dropdown->datas('Eligibility'),
                'licenses' => $this->dropdown->datas('License'),
                'levels' => $this->dropdown->datas('Level'),
                'types' => $this->dropdown->datas('Type'),
                'divisions' => $this->dropdown->dropdowns('Division'),
                'stations' => $this->dropdown->stations(),
                'positions' => $this->dropdown->positions(),
                'salaries' => $this->dropdown->salaries(),
                'deductions' => $this->dropdown->deductions(),
                'employment_statuses' => $this->dropdown->datas('Employment Status')
            ],
        ]);
    }
}
