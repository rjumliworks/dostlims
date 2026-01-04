<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $casts = [
        'form' => 'array',
        'contact' => 'array',
    ];

    protected $fillable = [
        'code','name','form','contact','samplecode_year','show_others','strict_mode','region_code'
    ];

    public function region()
    {
        return $this->belongsTo('App\Models\LocationRegion', 'region_code', 'code');
    }

    public function getFormAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }
}
