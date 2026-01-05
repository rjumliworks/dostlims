<?php

namespace App\Services\Common\Customer;

use Hashids\Hashids;
use App\Models\Customer;
use App\Models\CustomerConforme;
use App\Http\Resources\Common\Customer\IndexResource;

class UpdateClass
{
    public function customer($request)
    {
        $customer = Customer::with(['contact', 'address'])->findOrFail($request->id);
        $customer->updateIfDirty(
            $request->only([
                'industry_id',
                'classification_id',
                'type_id',
                'sex_id',
                'led_id',
            ])
        );
        optional($customer->contact)->updateIfDirty(
            $request->only(['email', 'contact_no'])
        );
        optional($customer->address)->updateIfDirty(
            $request->only([
                'province_code',
                'municipality_code',
                'barangay_code',
                'address',
            ])
        );

        return [
            'data'    => $customer->refresh(),
            'message' => 'Customer Updated',
            'info'    => 'The customer profile, contact information, and address were successfully updated.',
        ];
    }

    public function type($request)
    {
        $customer = Customer::findOrFail($request->id);
        $customer->updateIfDirty([
            'is_new' => $request->is_new,
        ]);

        return [
            'data'    => $customer->refresh(),
            'message' => 'Customer Status Updated',
            'info'    => $customer->is_new
                ? 'The customer has been marked as a new customer.'
                : 'The customer has been marked as an existing customer.',
        ];
    }

    public function conforme($request)
    {
        $conforme = CustomerConforme::findOrFail($request->id);
        $conforme->updateIfDirty(
            $request->only([
                'name',
                'contact_no',
            ])
        );
        return [
            'data'    => $conforme->refresh(),
            'message' => 'Conforme Updated',
            'info'    => 'The conforme details were successfully updated.',
        ];
    }

     public function status($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);

        $data = Customer::where('id',$id)->first();
        $data->is_active = $request->is_active;
        $data->save();

        $data = Customer::select('customers.*', 'customers.name as branch_name')
        ->join('customer_names', 'customers.name_id', '=', 'customer_names.id')
        ->with('customer_name:id,name','classification:id,name','sex:id,name','led:id,name','type:id,name','industry:id,name,industry_id,is_main,is_alone,is_active')
        ->with('address.region:code,name,region','address.province:code,name','address.municipality:code,name','address.barangay:code,name')->where('customers.id',$id[0])->first();
        return [
            'data' => new IndexResource($data),
            'message' => 'Customer Status', 
            'info' => "You've successfully updated the customer status."
        ];
    }

}
