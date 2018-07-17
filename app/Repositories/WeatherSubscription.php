<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 17.07.18
 * Time: 12:56
 */

namespace App\Repositories;


use App\API\OpenWeather\FetchWeather;
use App\API\OpenWeather\FetchWeatherForecasts;
use App\API\OpenWeather\TransformWeather;
use App\City;
use App\Weather;
use App\WeatherForecast;
use App\Contracts\WeatherSubscriptionInterface;
use App\User;

class WeatherSubscription implements WeatherSubscriptionInterface
{
    /**
     * @param User $user
     * @param City $city
     * @param string $channel
     * @return mixed
     */
    public function subscribe(User $user, City $city, $channel = 'broadcast')
    {
        return \App\WeatherSubscription::firstOrCreate([
            'userId' => $user->id,
            'cityId' => $city->id,
            'channel' => $channel
        ]);
    }

    /**
     * @param User $user
     * @param City $city
     * @param string $channel
     * @return bool
     */
    public function unsubscribe(User $user, City $city, $channel = 'broadcast')
    {
        return (bool) \App\WeatherSubscription::where('userId', $user->id)
            ->where('cityId',$city->id)
            ->where('channel', $channel)
            ->delete();
    }

    public function fetchByApi(\App\WeatherSubscription $weatherSubscription)
    {
        /** @var City $city */
        $city = $weatherSubscription->city;

        $repo = new FetchWeather();
        $result = $repo->getByCityId($city->apiId);

        $transformer = new TransformWeather();
        $weather = $transformer->toModel($result, $city->id);

        $model = Weather::where('cityId', $city->id)->first();

        $refreshForcasts = false;

        if (! $model instanceof Weather) {
            Weather::create($weather);
            $refreshForcasts = true;
        }
        else {
            if (array_get($weather, 'forecast') != $model->forecast) {
                $model->delete();
                Weather::create($weather);
                $refreshForcasts = true;
            }
        }

        //refresh the forecasts
        if ($refreshForcasts === true) {
            $repo = new FetchWeatherForecasts();
            //refresh the old ones
            WeatherForecast::where('cityId', $city->id)->delete();

            $result = $repo->getByCityId($city->apiId);

            foreach ($result as $listEntry) {
                $transformer = new TransformWeather();
                WeatherForecast::create( $transformer->toModel($listEntry, $city->id) );
            }
        }
    }
}