<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weather';

    protected $fillable = [
        'cityId', 'forecastDate', 'apiId', 'main', 'description', 'icon',
        'mainTemp', 'mainTempMin', 'mainTempMax', 'mainPressure', 'mainHumidity', 'mainSeaLevel', 'mainGroundLevel',
        'windSpeed', 'windDeg',
        'cloudsAll',
        'rainLast3H', 'snowLast3H',
        'sunrise', 'sunset',
        'lon', 'lat'
    ];

    protected $casts = [
        'mainTemp' => 'float',
        'mainTempMin' => 'float',
        'mainTempMax' => 'float',
        'mainPressure' => 'float',
        'mainHumidity' => 'float',
        'mainSeaLevel' => 'float',
        'mainGroundLevel' => 'float',
        'windSpeed' => 'float',
        'windDeg' => 'float',
        'rainLast3H' => 'float',
        'snowLast3H' => 'float',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'forecastDate', 'sunrise', 'sunset'
    ];
}
