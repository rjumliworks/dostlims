<?php

namespace App\Http\Resources\HumanResource\Employee;

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
            'id' => $this->id,
            'code' => $code,
            'email' => $this->email,
            'username' => $this->username,
            'avatar' => ($this->profile && $this->profile->avatar && $this->profile->avatar !== 'noavatar.jpg')
            ? asset('storage/' . $this->profile->avatar) 
            : asset('images/avatars/avatar.jpg'), 
            'name' => $this->profile->name,
            'fullname' => $this->profile->fullname,
            'profile' => new ProfileResource($this->profile),
            'mobile' => $this->profile->mobile,
            'birthdate' => $this->profile->birthdate,
            'organization' => $this->organization,
            'academics' => AcademicResource::collection($this->academics),
            'credentials' => $this->credentials,
            'contracts' => $this->contracts,
            'deductions' => $this->deductions,
            'created_at' => $this->created_at
        ];
    }
}
