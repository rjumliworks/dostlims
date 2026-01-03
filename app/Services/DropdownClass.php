<?php

namespace App\Services;

use App\Models\Facility;
use App\Models\ListRole;
use App\Models\ListData;
use App\Models\ListStatus;
use App\Models\ListDropdown;
use App\Models\ListLaboratory;
use App\Models\LocationRegion;
use App\Models\LocationProvince;
use App\Models\LocationMunicipality;
use App\Models\LocationBarangay;

class DropdownClass
{  
    public function facilities(){
        $data = Facility::with('province')->where('is_active',1)->get()->map(function ($item) {
            $name = $item->is_psto == 1
                ? $item->name . ' - (' . $item->province->name . ')'
                : $item->name;
            return [
                'value' => $item->id,
                'name' => $name,
            ];
        });
        return $data;
    }

    public function laboratories(){
        $data = ListLaboratory::where('is_active',1)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'short' => $item->short,
                'color' => $item->color,
                'is_active' => $item->is_active,
            ];
        });
        return $data;
    }

    public function dropdowns($class,$type = null){
        $data = ListDropdown::where('classification',$class)
        ->when($type, function ($query) use ($type){
            $query->where('type',$type);
        })
        ->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'others' => $item->others
            ];
        });
        return $data;
    }

    public function datas($type){
        $data = ListData::where('type',$type)->where('is_active',1)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function statuses($type){
        $data = ListStatus::where('classification',$type)->where('is_active',1)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'type' => $item->type,
                'color' => $item->color,
                'others' => $item->others,
            ];
        });
        return $data;
    }

    public function roles(){
        $data = ListRole::where('is_active',1)->orderBy('sequence','ASC')->get()->map(function ($item) {
            if ($item->is_lab == 1 && $item->has_lab == 0) {
                return [
                    'label' => 'Cross-Functional Users',
                    'options' => [
                        'value' => $item->id,
                        'name' => $item->name,
                        'has_lab' => $item->has_lab
                    ]
                ];
            }else if($item->is_lab == 1 && $item->has_lab == 1){
                return [
                    'label' => 'Lab-Scoped Users',
                    'options' => [
                        'value' => $item->id,
                        'name' => $item->name,
                        'has_lab' => $item->has_lab
                    ]
                ];
             }else if($item->is_lab == 0 && $item->has_lab == 0){
                return [
                    'label' => 'Finance Users',
                    'options' => [
                        'value' => $item->id,
                        'name' => $item->name,
                        'has_lab' => $item->has_lab
                    ]
                ];
            }
        });
        $grouped = $data->groupBy('label')->map(function ($items) {
            return [
                'label' => $items->first()['label'],
                'options' => $items->pluck('options')->values()
            ];
        })->values();

        return $grouped;
    }
    

    public function regions(){
        $data = LocationRegion::all()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->region
            ];
        });
        return $data;
    }

    public function provinces($code){
        $data = LocationProvince::where('region_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function municipalities($code){
        $data = LocationMunicipality::where('province_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function barangays($code){
        $data = LocationBarangay::where('municipality_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }
}
