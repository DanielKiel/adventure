<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Weather
{
    protected $table = 'weather_forecasts';
}
