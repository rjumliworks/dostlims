<?php

namespace App\Http\Resources\Common\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $address = ($this->address != '' || $this->address != NULL) ? $this->address.', ' : '';
        if($this->municipality->name == 'Zamboanga City' || $this->municipality->name == 'Isabela City'){
            $a = '';
        }else if($this->province->name == 'Sulu'){
            $a = ', '.$this->province->name;
        }else{
            $a = ', '.$this->province->name.', '.$this->region->region;
        }
        return [
            'name' => $address.$this->barangay->name.', '.$this->municipality->name.$a,
            'address' => $this->address,
            'region' => $this->region,
            'province' => $this->province,
            'municipality' => $this->municipality,
            'barangay' => $this->barangay,
        ];
    }
}
