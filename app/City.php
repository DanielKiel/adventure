<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'apiId', 'name', 'country', 'lon', 'lat'
    ];

    protected $casts = [
        'apiId' => 'integer',
        'lon' => 'float',
        'lat'=> 'float'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
