<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cityId')->unsigned()->nullable();
            $table->dateTime('forecastDate');
            $table->integer('apiId');
            $table->string('main');
            $table->string('description');
            $table->string('icon');

            $table->float('mainTemp')->default(0.00);
            $table->float('mainTempMin')->default(0.00);
            $table->float('mainTempMax')->default(0.00);
            $table->float('mainPressure')->default(0.00);
            $table->float('mainHumidity')->default(0.00);
            $table->float('mainSeaLevel')->default(0.00);
            $table->float('mainGroundLevel')->default(0.00);

            $table->float('windSpeed')->default(0.00);
            $table->float('windDeg')->default(0.00);

            $table->float('cloudsAll')->default(0.00);

            $table->float('rainLast3H')->default(0.00);
            $table->float('snowLast3H')->default(0.00);

            $table->dateTime('sunrise');
            $table->dateTime('sunset');

            $table->string('lon')->nullable();
            $table->string('lat')->nullable();
            $table->timestamps();

            $table->foreign('cityId')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather_forecasts', function(Blueprint $table) {
            $table->dropForeign('weather_forecasts_cityId_foreign');
        });

        Schema::dropIfExists('weather_forecasts');
    }
}
