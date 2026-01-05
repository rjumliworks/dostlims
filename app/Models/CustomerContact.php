<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerContact extends Model
{
    use LogsActivity;

    protected $fillable = [
        'kradworkz',
        'email',
        'contact_no',
        'tin',
        'customer_id'
    ];

    protected $hidden = [
        'kradworkz'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public function setEmailAttribute($value)
    {
        $email = strtolower($value);
        $this->attributes['email'] = Crypt::encryptString($email);
        $this->attributes['kradworkz'] = hash('sha256', $email);
    }

    public function getEmailAttribute($value)
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

    public function setTinAttribute($value)
    {
        $this->attributes['tin'] = ($value) ? Crypt::encryptString($value) : NULL;
    }

    public function getTinAttribute($value)
    {
        return ($value) ? Crypt::decryptString($value) : null;
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
        ->logOnly(['email','contact_no','tin'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Contact')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
