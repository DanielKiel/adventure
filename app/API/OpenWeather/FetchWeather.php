<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 16.07.18
 * Time: 15:34
 */

namespace App\API\OpenWeather;


use GuzzleHttp\Client;

class FetchWeather
{
    /**
     * @param $cityID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByCityId($cityID)
    {
        $url = config('weatherAPI.url', 'api.openweathermap.org/data/2.5/weather');
        $key = config('weatherAPI.apiKey');

        $client = new Client([
            'exceptions' => false
        ]);

        $request = $client->request('GET',$url, [
            'query' => [
                'id' => $cityID,
                'appid' => $key
            ]
        ]);

        return json_decode($request->getBody()->getContents());
    }
}