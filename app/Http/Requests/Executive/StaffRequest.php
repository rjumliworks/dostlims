<?php

namespace App\Http\Requests\Executive;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'sometimes|required|max:20|unique:users,username,'.$this->id,
            'email' => 'sometimes|required|email|max:150|unique:users,email,'.$this->id,
            'firstname' => 'sometimes|required|string|max:100',
            'lastname' => 'sometimes|required|string|max:100',
            'middlename' => 'sometimes|required|string|max:50',
            'suffix_id' => 'sometimes|nullable',
            'sex_id' => 'sometimes|required',
            'mobile' => 'sometimes|required|numeric|digits:11|unique:user_profiles,mobile,'.$this->profile_id,
            'facility_id' => 'sometimes|required',
            'role_id' => 'sometimes|required',
        ];
    }

    public function messages(){
        return [
            'mobile.required' => 'required',
            'username.required' => 'required',
            'email.required' => 'required',
            'sex_id.required' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->username && $this->email) {
            $this->merge([
                'username' => explode('@', $this->email)[0]
            ]);
        }
    }
}
