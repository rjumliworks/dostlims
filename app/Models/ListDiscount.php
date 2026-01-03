<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class ListDiscount extends Model
{
    use LogsActivity;
    
    protected $fillable = [
        'id','name','value','from','to','type_id','subtype_id','based_id','is_active'
    ];

    public function based()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'based_id', 'id');
    } 

    public function type()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
    } 

    public function subtype()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'subtype_id', 'id');
    } 

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['id','name','value','from','to','type_id','subtype_id','based_id','is_active'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} the facility information")
        ->useLogName('Facility')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
