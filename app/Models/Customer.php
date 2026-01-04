<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Customer extends Model
{
    use LogsActivity;

    protected $fillable = [
        'code',
        'name',
        'name_id',
        'industry_id',
        'classification_id',
        'sex_id',
        'led_id',
        'type_id',
        'is_active',
        'is_internal',
        'is_main',
        'user_id',
        'is_new'
    ];

    public function conformes()
    {
        return $this->hasMany('App\Models\CustomerConforme', 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function customer_name()
    {
        return $this->belongsTo('App\Models\CustomerName', 'name_id', 'id');
    }

    public function contact()
    {
        return $this->hasOne('App\Models\CustomerContact', 'customer_id');
    }

    public function address()
    {
        return $this->hasOne('App\Models\CustomerAddress', 'customer_id');
    }

     public function type()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'classification_id', 'id');
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\ListIndustry', 'industry_id', 'id');
    }

    public function sex()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'sex_id', 'id');
    }

    public function led()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'led_id', 'id');
    }

    public function setContactNoAttribute($value)
    {
        $this->attributes['contact_no'] = Crypt::encryptString($value);
    }

    public function getContactNoAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function getEmailAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
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
        ->logOnly(['name','name_id','industry_id','classification_id','type_id','sex_id','led_id'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Customer')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
