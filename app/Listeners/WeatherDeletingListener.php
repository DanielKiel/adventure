<?php

namespace App\Listeners;

use App\Events\WeatherDeleting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeatherDeletingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WeatherDeleting  $event
     * @return void
     */
    public function handle(WeatherDeleting $event)
    {
        //
    }
}
