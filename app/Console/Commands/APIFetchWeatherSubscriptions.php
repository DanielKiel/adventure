<?php

namespace App\Console\Commands;

use App\Jobs\FetchWeatherSubscription;
use App\WeatherSubscription;
use Illuminate\Console\Command;

class APIFetchWeatherSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        WeatherSubscription::chunk(100, function($subscriptions) {
            foreach ($subscriptions as $subscription) {
                $job = new FetchWeatherSubscription($subscription);
                dispatch($job);
            }
        });
    }
}
