<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'apiId' => $faker->numberBetween(1111111, 9999999),
        'name' => $faker->city,
        'country' =>$faker->countryCode,
        'lon' => $faker->longitude,
        'lat' =>$faker->latitude
    ];
});
