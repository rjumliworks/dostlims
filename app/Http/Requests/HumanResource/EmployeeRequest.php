<?php

namespace App\Http\Requests\HumanResource;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch($this->option){
            case 'employee':
                return [
                    'username' => 'sometimes|required|max:20|unique:users,username,'.$this->id,
                    'email' => 'sometimes|required|email|max:150|unique:users,email,'.$this->id,
                    'firstname' => 'sometimes|required|string|max:100',
                    'lastname' => 'sometimes|required|string|max:100',
                    'middlename' => 'sometimes|required|string|max:50',
                    'suffix_id' => 'sometimes|nullable',
                    'sex_id' => 'sometimes|required',
                    'birthdate' => 'sometimes|required',
                    'mobile' => 'sometimes|required|numeric|digits:11|unique:user_profiles,mobile,'.$this->profile_id,
                    'marital_id' => 'sometimes|required',
                    'religion_id' => 'sometimes|required',
                    'blood_id' => 'sometimes|required',
                    'division_id' => 'sometimes|required',
                    'station_id' => 'sometimes|required',
                    'unit_id' => 'sometimes|required',
                    'type_id' => 'sometimes|required',
                    'position_id' => 'sometimes|required',
                    'salary_id' => 'sometimes|required',
                ];
            break;
            case 'credential':
                return [
                    'name_id' => [
                        'required',
                        Rule::unique('user_credentials')->where(function ($query){
                            return $query->where('type_id', $this->type_id)
                                         ->where('user_id', $this->user_id);
                        }),
                    ],
                    'type_id' => 'required',
                    'user_id' => 'required',
                ];
            break;
            case 'academic':
                return [
                    'school_id' => 'required',
                    'course_id' => 'required',
                    'is_ongoing' => 'required',
                    'level_id' => 'required',
                    'user_id' => 'required',
                    'graduated_at' => 'required_if:is_ongoing,0'
                ];
            break;
            case 'contract':
                return [
                    'start_at' => 'required',
                    'end_at' => 'required',
                    'status_id' => 'required',
                    'type_id' => 'required',
                    'position_id' => 'required',
                    'salary_id' => 'required',
                    'division_id' => 'required',
                    'unit_id' => 'required',
                    'station_id' => 'required',
                    'user_id' => 'required'
                ];
            break;
            default: 
                return [];
        }
    }

    public function messages()
    {
        switch($this->option){
            case 'employee':
                return [
                    'mobile.required' => 'required',
                    'username.required' => 'required',
                    'email.required' => 'required',
                    'birthdate.required' => 'required',
                    'sex_id.required' => 'required',
                    'marital_id.required' => 'required',
                    'religion_id.required' => 'required',
                    'blood_id.required' => 'required',
                    'marital_id.required' => 'required',
                    'salary_id.required' => 'required'
                ];
            break;
            case 'credential':
                return [
                    'name_id.required' => 'The credential field is required',
                    'name_id.unique' => 'The credential has already been taken'
                ];
            break;
            case 'academic':
                return [
                    'school_id.required' => 'required',
                    'course_id.required' => 'required',
                    'level_id.required' => 'required',
                    'graduated_at.required_if' => 'required',
                ];
            break;
            case 'contract':
               return [
                'start_at.required' => 'Please specify the start date.',
                'end_at.required' => 'Please specify the end date.',
                'status_id.required' => 'Please select an employment status.',
                'type_id.required' => 'Please select the appointment type.',
                'position_id.required' => 'Please select a position.',
                'salary_id.required' => 'Please select grade.',
                'division_id.required' => 'Please select a division.',
                'unit_id.required' => 'Please select a unit.',
                'station_id.required' => 'Please select a station.',
                'user_id.required' => 'A user must be assigned to this record.',
            ];
            break;
            default: 
                return [];
        }
    }
}
