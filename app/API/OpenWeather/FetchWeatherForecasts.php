<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 17.07.18
 * Time: 10:02
 */

namespace App\API\OpenWeather;


use GuzzleHttp\Client;

class FetchWeatherForecasts
{
    public function getByCityId($cityID)
    {
        $url = config('weatherAPI.forecastUrl', 'api.openweathermap.org/data/2.5/forecast');
        $key = config('weatherAPI.apiKey');

        $client = new Client([
            'exceptions' => false
        ]);

        $request = $client->request('GET',$url, [
            'query' => [
                'id' => $cityID,
                'appid' => $key,
                'units' => 'metric',
                'lang' => 'de'
            ]
        ]);

        //check if all is ok
        if ($request->getStatusCode() !== 200) {
            //do something here
        }

        $all = json_decode($request->getBody()->getContents());

        return $all->list;
    }
}