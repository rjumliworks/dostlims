<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerAddress extends Model
{
    use LogsActivity;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
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

    public function district()
    {
        return $this->belongsTo('App\Models\LocationDistrict', 'district_code', 'code');
    }

    public function barangay()
    {
        return $this->belongsTo('App\Models\LocationBarangay', 'barangay_code', 'code');
    }

    public function updateIfDirty(array $attributes){
        $this->fill($attributes);
        $dirtyAttributes = $this->getDirty();
        if(!empty($dirtyAttributes)) {
            $originalAttributes = array_intersect_key($this->getOriginal(), $dirtyAttributes);
            $updated = $this->update($dirtyAttributes);
            return $updated;
        }
        return false;
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['province_code','municipality_code','barangay_code','address'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Address')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
