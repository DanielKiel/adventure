<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherSubscription extends Model
{
    protected $fillable = [
        'cityId',
        'userId',
        'channel',
        'orderId'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'cityId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
