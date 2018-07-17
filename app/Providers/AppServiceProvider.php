<?php

namespace App\Providers;

use App\Contracts\WeatherSubscriptionInterface;
use App\Repositories\WeatherSubscription;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (glob(app_path('/helper/*.php')) as $filename) {
            require $filename;
        }

        $this->app->bind(WeatherSubscriptionInterface::class, WeatherSubscription::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
