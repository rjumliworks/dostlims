<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerName extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'has_branches', 'is_active'];

    public function customer()
    {
        return $this->hasMany('App\Models\Customer', 'name_id');
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['name', 'has_branches', 'is_active'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Name')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
