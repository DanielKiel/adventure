<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 17.07.18
 * Time: 09:28
 */

namespace App\API\OpenWeather;


use Carbon\Carbon;

class TransformWeather
{
    public function toModel(\stdClass $object, $cityId = null)
    {
        $model = (array) $object;

        array_set(
            $model,
            'weather',
            array_first( array_get($model, 'weather', []) )
        );

        $model = array_dot(recursiveToArray($model));

        /*example
            "coord.lon" => 12.07
            "coord.lat" => 50.47
            "weather.id" => 800
            "weather.main" => "Clear"
            "weather.description" => "clear sky"
            "weather.icon" => "01d"
            "base" => "stations"
            "main.temp" => 294.06
            "main.pressure" => 1015
            "main.humidity" => 49
            "main.temp_min" => 292.15
            "main.temp_max" => 295.15
            "visibility" => 10000
            "wind.speed" => 3.1
            "wind.deg" => 300
            "clouds.all" => 0
            "dt" => 1531812000
            "sys.type" => 1
            "sys.id" => 4919
            "sys.message" => 0.209
            "sys.country" => "DE"
            "sys.sunrise" => 1531797575
            "sys.sunset" => 1531854929
            "id" => 2882360
            "name" => "Kürbitz"
            "cod" => 200
        */

        return [
            'cityId' => $cityId,
            'forecastDate' => Carbon::createFromTimestamp( array_get($model, 'dt') ),
            'apiId' => array_get($model, 'weather.id'),
            'main' => array_get($model, 'weather.main'),
            'description' => array_get($model, 'weather.description'),
            'icon' => array_get($model, 'weather.icon'),
            'mainTemp' => array_get($model, 'main.temp', 0.00),
            'mainTempMin' => array_get($model, 'main.temp_min', 0.00),
            'mainTempMax'=> array_get($model, 'main.temp_max', 0.00),
            'mainPressure' => array_get($model, 'main.pressure', 0.00),
            'mainHumidity' => array_get($model, 'main.humidity', 0.00),
            'mainSeaLevel' => array_get($model, 'main.sea_level', 0.00),
            'mainGroundLevel' => array_get($model, 'main.grnd_level', 0.00),
            'windSpeed' => array_get($model, 'wind.speed', 0.00),
            'windDeg' => array_get($model, 'wind.deg', 0.00),
            'cloudsAll' => array_get($model, 'clouds.all', 0.00),
            'rainLast3H' => array_get($model, 'rain.3h', 0.00),
            'snowLast3H' => array_get($model, 'snow.3h', 0.00),
            'sunrise' => Carbon::createFromTimestamp( array_get($model, 'sys.sunrise') ),
            'sunset'=> Carbon::createFromTimestamp( array_get($model, 'sys.sunset') ),
            'lon' => array_get($model, 'coord.lon'),
            'lat' => array_get($model, 'coord.lat')
        ];
    }
}