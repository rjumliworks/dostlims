<?php

namespace App\Http\Resources\Executive\Facility;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($this->id);

        return [
            'code' => $code,
            'name' => $this->name,
            'short' => $this->short,
            'is_regional' => $this->is_regional,
            'is_separated' => $this->is_separated,
            'is_psto' => $this->is_psto,
            'is_active' => $this->is_active,
            'address' => $this->address,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'barangay' => $this->barangay,
            'municipality' => $this->municipality,
            'province' => $this->province,
            'region' => $this->region,
            'created_at' => $this->created_at
        ];
    }
}
