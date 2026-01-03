<?php

namespace App\Http\Controllers\Executive;

use App\Traits\HandlesTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropdownClass;
use App\Services\Executive\Discount\SaveClass;
use App\Services\Executive\Discount\ViewClass;

class DiscountController extends Controller
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
            return inertia('Executive/Discounts/Index',[
                'dropdowns' => [
                    'laboratories' => $this->dropdown->laboratories(),
                    'regions' => $this->dropdown->regions(),
                ]
            ]); 
        }   
    }

    public function update(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->save->update($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

}
