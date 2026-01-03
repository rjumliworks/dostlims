<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name','short','is_regional','is_psto','is_separated','address','longitude','latitude','is_active','barangay_code','municipality_code','province_code','region_code'
    ];

    public function laboratories()
    {
        return $this->hasMany('App\Models\FacilityLaboratory', 'facility_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\LocationRegion', 'region_code', 'code');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\LocationProvince', 'province_code', 'code');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Models\LocationMunicipality', 'municipality_code', 'code');
    }

    public function barangay()
    {
        return $this->belongsTo('App\Models\LocationBarangay', 'barangay_code', 'code');
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['name','short','is_regional','is_psto','is_separated','address','longitude','latitude','is_active','barangay_code','municipality_code','province_code','region_code'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} the facility information")
        ->useLogName('Facility')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
