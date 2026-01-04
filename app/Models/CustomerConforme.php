<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerConforme extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'contact_no',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    public function getNameAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setContactNoAttribute($value)
    {
        $this->attributes['contact_no'] = Crypt::encryptString($value);
    }

    public function getContactNoAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function updateIfDirty(array $attributes){
        $dirtyAttributes = [];
        foreach ($attributes as $key => $value) {
            $currentValue = $this->$key;
            if ($value !== $currentValue) {
                $dirtyAttributes[$key] = $value;
            }
        }
        if(!empty($dirtyAttributes)) {
            $originalAttributes = array_intersect_key($this->getOriginal(), $dirtyAttributes);
            $updated = $this->update($dirtyAttributes);
            return $updated;
        }
        return false;
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['name','contact_no','customer_id'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Conforme')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
