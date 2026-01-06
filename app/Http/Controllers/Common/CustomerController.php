<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;
use App\Services\DropdownClass;
use App\Services\Common\Customer\SaveClass;
use App\Services\Common\Customer\ViewClass;
use App\Services\Common\Customer\UpdateClass;
use App\Http\Requests\Common\CustomerRequest;

class CustomerController extends Controller
{
    use HandlesTransaction;

    protected ViewClass $view;
    protected SaveClass $save;
    protected UpdateClass $update;
    protected DropdownClass $dropdown;

    public function __construct(DropdownClass $dropdown, SaveClass $save, ViewClass $view, UpdateClass $update){
        $this->dropdown = $dropdown;
        $this->view = $view;
        $this->save = $save;
        $this->update = $update;
    }

    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->view->list($request);
            break;
            case 'search':
                return $this->view->search($request);
            break;
            case 'logs':
                return $this->view->logs($request);
            break;
            default:
            return inertia('Modules/Customers/Index',[
                'dropdowns' => [
                    'industries' => $this->dropdown->industries(),
                    'sexs' => $this->dropdown->dropdowns('Sex','n/a'),
                    'individuals' => $this->dropdown->dropdowns('Individual','n/a'),
                    'classes' => $this->dropdown->dropdowns('Class','n/a'),
                    'individuals' => $this->dropdown->dropdowns('Individual','n/a'),
                    'sexs' => $this->dropdown->dropdowns('Sex','n/a'),
                    'females' => $this->dropdown->dropdowns('Female','n/a'),
                    'males' => $this->dropdown->dropdowns('Male','n/a'),
                    'regions' => $this->dropdown->regions(),
                ],
                'region' => $this->view->region()
            ]);
        }
    }

    public function store(CustomerRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'customer':
                    return $this->save->customer($request);
                break;
                case 'validation':
                    return $this->save->validation($request);
                break;
                case 'conforme':
                    return $this->save->conforme($request);
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

    public function update(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            if($request->option == 'customer'){
                return $this->update->customer($request);
            }else if($request->option == 'type'){
                return $this->update->type($request);
            }else if($request->option == 'status'){
                return $this->update->status($request);
            }else{
                return $this->update->conforme($request);
            }
        });
        
        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function show($id){
        $customer = $this->view->view($id);
        return inertia('Modules/Customers/Profile/Index',[
            'customer' => $customer
        ]);
    }
}
