<?php

namespace App\Events;

use App\WeatherSubscription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WeatherSubscriptionActualized
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $weatherSubscription;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(WeatherSubscription $weatherSubscription)
    {
        $this->weatherSubscription = $weatherSubscription;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if ($this->weatherSubscription->channel === 'broadcast') {
            return new PrivateChannel('weather_subscription_user_' . $this->weatherSubscription->userId);
        }

        return [];


    }
}
