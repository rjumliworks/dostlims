<?php

namespace App\Services\Common\Customer;

use App\Models\Customer;
use App\Models\CustomerConforme;

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

}
