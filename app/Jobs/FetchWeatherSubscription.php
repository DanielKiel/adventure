<?php

namespace App\Jobs;

use App\API\OpenWeather\FetchWeather;
use App\API\OpenWeather\FetchWeatherForecasts;
use App\API\OpenWeather\TransformWeather;
use App\City;
use App\Contracts\WeatherSubscriptionInterface;
use App\Weather;
use App\WeatherForecast;
use App\WeatherSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchWeatherSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $weatherSubscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WeatherSubscription $weatherSubscription)
    {
        $this->weatherSubscription = $weatherSubscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var WeatherSubscriptionInterface $repo */
        $repo = app()->make(WeatherSubscriptionInterface::class);

        $repo->fetchByApi($this->weatherSubscription);
    }
}
