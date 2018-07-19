<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function weather(): HasOne
    {
        return $this->hasOne(Weather::class, 'cityId');
    }

    public function weatherForecast(): HasMany
    {
        return $this->hasMany(WeatherForecast::class, 'cityId');
    }
}
