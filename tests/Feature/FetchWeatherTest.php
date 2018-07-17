<?php

namespace Tests\Feature;

use App\Weather;
use App\WeatherArchive;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchWeatherTest extends TestCase
{
    public function test_archive_functionality()
    {
        $weather = factory(Weather::class)->create();

        $this->assertEquals(1, Weather::count());

        $this->assertTrue((bool) $weather->delete());

        $this->assertEquals(1, WeatherArchive::count());
    }
}
