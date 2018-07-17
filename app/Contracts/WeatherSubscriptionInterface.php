<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 17.07.18
 * Time: 13:21
 */

namespace App\Contracts;


use App\City;
use App\User;

interface WeatherSubscriptionInterface
{
    public function subscribe(User $user, City $city, $channel = 'broadcast');

    public function unsubscribe(User $user, City $city, $channel = 'broadcast');

    public function fetchByApi(\App\WeatherSubscription $weatherSubscription);
}