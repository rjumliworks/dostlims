<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationLog extends Model
{
    protected $table = 'authentication_logs';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'authenticatable_id', 'id');
    }
}
