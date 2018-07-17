<?php

namespace Tests\Feature;

use App\City;
use App\Contracts\WeatherSubscriptionInterface;
use App\WeatherSubscription;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeatherSubscriptionTest extends TestCase
{
    public function test_subscribe_and_unsubscribe()
    {
        $city = City::first();

        /** @var WeatherSubscriptionInterface $repo */
        $repo = app()->make(WeatherSubscriptionInterface::class);

        $repo->subscribe($this->user, $city);

        $subscription = WeatherSubscription::first();

        $this->assertInstanceOf(WeatherSubscription::class, $subscription);

        $repo->subscribe($this->user, $city);

        $this->assertEquals(1, WeatherSubscription::count());

        $repo->unsubscribe($this->user, $city);

        $subscription = WeatherSubscription::first();

        $this->assertEmpty($subscription);

        $this->assertEquals(0, WeatherSubscription::count());
    }
}
