<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'username',
        'email',
        'kradworkz',
        'password',
        'code',
        'is_active',
        'is_locked',
        'must_change',
        'email_verified_at',
        'password_changed_at',
        'two_factor_confirmed_at',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    protected $hidden = [
        'kradworkz',
        'password',
        'remember_token',
        'code',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id');
    }

    public function organization()
    {
        return $this->hasOne('App\Models\UserOrganization', 'user_id');
    }

    public function academics()
    {
        return $this->hasMany('App\Models\UserAcademic', 'user_id');
    }

    public function contracts()
    {
        return $this->hasMany('App\Models\UserContract', 'user_id');
    }

    public function credentials()
    {
        return $this->hasMany('App\Models\UserCredential', 'user_id')->orderBy('created_at','DESC');
    }

    public function deductions()
    {
        return $this->hasMany('App\Models\UserDeduction', 'user_id')->orderBy('created_at','DESC');
    }

    public function credits()
    {
        return $this->hasMany('App\Models\UserCredit', 'user_id')->orderBy('created_at','DESC');
    }

    public function folders()
    {
        return $this->hasMany('App\Models\UserFolder', 'user_id');
    }

    public function myroles()
    {
        return $this->hasMany('App\Models\UserRole', 'user_id')->orderBy('is_active','DESC');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\ListRole', 'user_roles', 'user_id', 'role_id');
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
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

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? date('M d, Y g:i a', strtotime($value)) : null;
    }

    public function getLastLoginAtAttribute($value)
    {
        return $value ? date('M d, Y g:i a', strtotime($value)) : null;
    }

    public function getPasswordChangedAtAttribute($value)
    {
        return $value ? date('F d, Y g:i a', strtotime($value)) : null;
    }

    public function getTwoFactorConfirmedAtAttribute($value)
    {
        return $value ? date('M d, Y g:i a', strtotime($value)) : null;
    }
    
    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly(['username','kradworkz','is_active','must_change'])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} the user information")
        ->useLogName('User')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
