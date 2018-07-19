<?php

namespace App\Http\Controllers;

use App\City;
use App\Contracts\WeatherSubscriptionInterface;
use App\Jobs\FetchWeatherSubscription;
use App\WeatherSubscription;
use Illuminate\Http\Request;

class WeatherSubscriptionController extends Controller
{
    /** @var WeatherSubscriptionInterface  */
    public $repo;

    public function __construct(WeatherSubscriptionInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return WeatherSubscription::where('userId', auth()->user()->id)
            ->with('city','city.weather','city.weatherForecast')
            ->get();
    }

    public function subscribe(City $city)
    {
        $sub = $this->repo->subscribe(auth()->user(), $city);

        $job = new FetchWeatherSubscription($sub);
        $this->dispatch($job);

        return $sub->load(['city', 'city.weather', 'city.weatherForecast'])->toArray();
    }

    public function unsubscribe(City $city)
    {
        $this->repo->unsubscribe(auth()->user(), $city);
    }
}
