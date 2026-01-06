<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if($this->option == 'customer'){
            return [
                'customer' => 'required',
                'has_branches' => 'sometimes|required',
                'name' => 'sometimes|required_if:has_branches,true|unique:customers,name,NULL,'.$this->id.',name_id,'.$this->name_id,
                'email' => 'sometimes|required|email',
                'contact_no' => 'required|numeric|digits:11',
                'industry_id' => 'sometimes|required|integer',
                'sex_id' => 'sometimes|required|integer',
                'type_id' => 'sometimes|required_if:classification_id,9',
                'classification_id' => 'sometimes|required|integer',
                'address' => 'sometimes|nullable|string|max:200',
                'region_code' => 'sometimes|required',
                'province_code' => 'sometimes|required',
                'municipality_code' => 'sometimes|required',
                'barangay_code' => 'sometimes|required',
                'longitude' => 'sometimes|required',
                'latitude' => 'sometimes|required',
                'is_new' => 'required'
            ];
        }else if($this->option == 'validation'){
            return [
                'customer' => 'required',
                'has_branches' => 'sometimes|required',
                'name' => 'sometimes|required_if:has_branches,true|unique:customers,name,NULL,'.$this->id.',name_id,'.$this->name_id,
                'email' => 'sometimes|required|email',
                'contact_no' => 'required|numeric|digits:11',
                'industry_id' => 'sometimes|required|integer',
                'sex_id' => 'sometimes|required|integer',
                'type_id' => 'sometimes|required_if:classification_id,9',
                'classification_id' => 'sometimes|required|integer',
                'address' => 'sometimes|nullable|string|max:200',
                'region_code' => 'sometimes|required',
                'province_code' => 'sometimes|required',
                'municipality_code' => 'sometimes|required',
                'barangay_code' => 'sometimes|required',
                'longitude' => 'sometimes|required',
                'latitude' => 'sometimes|required',
                // 'is_new' => 'required'
            ];
        }else{
            return [
                'name' => 'required|string',
                'contact_no' => 'required|numeric|digits:11',
            ];
        }
    }

    public function messages()
    {
        return [
            'type_id.required_if' => 'required',
        ];
    }
}
