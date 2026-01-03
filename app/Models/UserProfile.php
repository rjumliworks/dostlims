<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserProfile extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected $fillable = [
        'lastname', 
        'firstname',
        'middlename',
        'mobile',
        'mobile_hash',
        'avatar',
        'signature',
        'sex_id',
        'suffix_id',
        'user_id', 
    ];
    protected $appends = ['name','fullname'];
    protected $encryptable = [
        'firstname',
        'middlename',
        'birthdate',
        'mobile'
    ];
    protected $hidden = [
        'mobile_hash'
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function sex()      { return $this->belongsTo(ListData::class, 'sex_id'); }
    public function suffix()   { return $this->belongsTo(ListData::class, 'suffix_id'); }

    public function getFullnameAttribute()
    {
        $middleInitial = $this->middlename ? strtoupper($this->middlename[0]) . '.' : '';
        $name = trim("{$this->firstname} {$middleInitial} {$this->lastname}");
        if ($this->suffix?->name) {
            $name .= ', ' . $this->suffix->name;
        }
        return $name;
    }

    public function getNameAttribute()
    {
        $middleInitial = $this->middlename ? strtoupper($this->middlename[0]) . '.' : '';
        $parts = [trim($this->lastname) . ',', trim($this->firstname), $middleInitial, $this->suffix?->name];
        return implode(' ', array_filter($parts));
    }


    public function setAttribute($key, $value)
    {
        if (in_array($key, ['firstname', 'middlename', 'lastname','mobile']) && !is_null($value)) {
            $value = ucfirst(strtolower($value));
        }

        if (in_array($key, $this->encryptable) && !is_null($value) && $value !== '') {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Throwable $e) {
                return $value;
            }
        }
        return $value;
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            if (! empty($model->mobile)) {
                $plainMobile = $model->mobile;
                $normalized = preg_replace('/\D+/', '', $plainMobile);
                $model->mobile_hash = hash('sha256', $normalized);
            }
        });
    }

    protected static $recordEvents = ['updated'];
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly([
            'firstname',
            'lastname',
            'middlename',
            'suffix_id',
            'sex_id',
            'mobile',
            'mobile_hash',
            'signature',
            'avatar'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "$eventName the profile information")
        ->useLogName('User Profile')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
