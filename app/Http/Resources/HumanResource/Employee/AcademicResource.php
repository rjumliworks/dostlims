<?php

namespace App\Http\Resources\HumanResource\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school' => $this->school,
            'course' => $this->course,
            'level' => $this->level,
            'is_ongoing' => $this->ongoing,
            'graduated_at' => $this->graduated_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
