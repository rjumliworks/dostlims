<?php

namespace App\Services\Common\Customer;

use App\Models\Customer;
use App\Models\CustomerName;
use App\Models\Configuration;
use App\Http\Resources\Common\Customer\IndexResource;

class ViewClass
{
    public function list($request){
        $data = Customer::select('customers.*', 'customers.name as branch_name')
        ->join('customer_names', 'customers.name_id', '=', 'customer_names.id')
        ->with('customer_name:id,name','classification:id,name','sex:id,name','led:id,name','industry:id,name,industry_id,is_main,is_alone,is_active')
        ->with('address.region:code,name,region','address.province:code,name','address.municipality:code,name','address.barangay:code,name')
        ->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw("
                    CASE
                        WHEN customers.is_main = 1 THEN customer_names.name
                        ELSE CONCAT(customer_names.name, ' - ', customers.name)
                    END LIKE ?
                ", ["%{$keyword}%"]);
            });
        })
        ->with('customer_name')
        ->when($request->type, function ($query, $type) {
            match ($type) {
                'New Customer' => $query->where('is_new', 1),
                'Old Customer' => $query->where('is_new', 0),
                'Not Identified' => $query->whereNull('is_new'),
            };
        })
        ->when($request->class, fn ($q, $v) => $q->where('classification_id', $v))
        ->when($request->industry, fn ($q, $v) => $q->where('industry_id', $v))
        ->when($request->sex, fn ($q, $v) => $q->where('sex_id', $v))
        ->when($request->individual, fn ($q, $v) => $q->where('type_id', $v))
        ->orderBy('customers.created_at', 'desc')
        ->paginate($request->count ?? 20);

        return IndexResource::collection($data);
    }

    public function search($request){
        $keyword = $request->keyword;
        if($keyword){
            $data = CustomerName::where('name', 'LIKE', "%{$keyword}%")->get()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'name' => $item->name,
                    'has_branches' => $item->has_branches
                ];
            });
            return $data;
        }else{
            return [];
        }
    }

    public function region(){
        return Configuration::value('region_code');
    }
}
