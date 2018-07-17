<?php

use Faker\Generator as Faker;

$factory->define(App\Weather::class, function (Faker $faker) {
    return [
        "cityId" => null,
        "forecastDate" => $faker->dateTime,
        "apiId" => $faker->numberBetween(111,999),
        "main" => "Rain",
        "description" => "shower rain",
        "icon" => "09d",
        "mainTemp" => $faker->randomFloat(2, 100, 1000),
        "mainTempMin" => $faker->randomFloat(2, 100, 1000),
        "mainTempMax" => $faker->randomFloat(2, 100, 1000),
        "mainPressure" => $faker->randomFloat(2, 100, 1000),
        "mainHumidity" => $faker->randomFloat(2, 100, 1000),
        "mainSeaLevel" => $faker->randomFloat(2, 100, 1000),
        "mainGroundLevel" => $faker->randomFloat(2, 100, 1000),
        "windSpeed" => $faker->randomFloat(2, 100, 1000),
        "windDeg" => $faker->randomFloat(2, 100, 1000),
        "cloudsAll" => $faker->randomFloat(2, 100, 1000),
        "rainLast3H" => $faker->randomFloat(2, 100, 1000),
        "snowLast3H" => $faker->randomFloat(2, 100, 1000),
        "sunrise" => $faker->dateTime,
        "sunset" =>$faker->dateTime,
        "lon" => $faker->longitude,
        "lat" => $faker->latitude
    ];
});
