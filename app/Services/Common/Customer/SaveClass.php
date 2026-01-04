<?php

namespace App\Services\Common\Customer;

use App\Models\Customer;
use App\Models\CustomerName;
use App\Models\CustomerConforme;
use App\Models\Configuration;

class SaveClass
{
    public function conforme($request){
        $data = CustomerConforme::create($request->all());
        $customer = CustomerConforme::findOrFail($data->id);
        $conforme = [
            'value' => $customer->id,
            'name' => $customer->name,
            'contact_no' => $customer->contact_no
        ];

        return [
            'data' => $conforme,
            'message' => 'Conforme was updated!', 
            'info' => "You've successfully updated the conforme."
        ];
    }

    public function customer($request)
    {
        $nameId = $this->resolveCustomerName($request);
        $code = $this->generateCode();

        $customer = Customer::create([
            ...$request->except(['customer']),
            'name_id' => $nameId,
            'code'    => $code,
            'user_id' => \Auth::id(),
        ]);

        $customer->address()->create(
            $request->except([
                'name',
                'tin',
                'is_main',
                'email',
                'industry_id',
                'classification_id',
                'sex_id',
                'led_id',
                'type_id',
                'contact_no',
                'name_id',
                'is_new',
                'customer',
                'has_branches',
                'add_to_conforme',
                'option',
            ])
        );

        $customer->contact()->create($request->all());

        if($request->add_to_conforme){
            $customer->conformes()->create([
                'name' => $customer->customer_name->name,
                'contact_no' => $request->contact_no
            ]);
        }

        return [
            'data' => $customer,
            'message' => 'Customer creation was successful!', 
            'info' => "You've successfully created the new customer."
        ];
    }

    private function resolveCustomerName($request): int
    {
        if ($request->customer['value'] === $request->customer['name']) {
            return CustomerName::create([
                'name'         => $request->customer['value'],
                'has_branches' => $request->has_branches,
            ])->id;
        }

        $name = CustomerName::findOrFail($request->customer['value']);
        $name->update(['has_branches' => true]);

        return $name->id;
    }

    private function generateCode(): string
    {
        $code = Configuration::value('code');
        $latestCustomer = Customer::lockForUpdate()->latest('id')->first();
        $nextNumber = $latestCustomer ? ((int) substr($latestCustomer->code, -5)) + 1 : 1;
        return sprintf('%s-CSTMR-%05d', $code, $nextNumber);
    }
}
