<?php

namespace App\Http\Resources\Common\Customer;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($this->id);

        return [
            'code' => $code,
            'id' => $this->id,
            'ccode' => $this->code,
            'email' => $this->contact->email,
            'contact_no' => $this->contact->contact_no,
            'name' => $this->name,
            'customer' => ($this->is_main) ? $this->customer_name->name :  $this->customer_name->name.' - '.$this->branch_name,
            'is_main' => $this->is_main,
            'is_active' => $this->is_active,
            'is_synced' => $this->is_synced,
            'is_new' => $this->is_new,
            'customer_name' => $this->customer_name->name,
            'classification' => $this->classification,
            'type' => $this->type,
            'led' => $this->led,
            'industry' => $this->industry,
            'sex' => $this->sex,
            'address' => new AddressResource($this->address),
            'conformes' => $this->conformes,
            'created_at' => $this->created_at
        ];
    }
}
