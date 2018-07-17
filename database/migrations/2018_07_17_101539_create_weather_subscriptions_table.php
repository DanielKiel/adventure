<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userId')->unsigned()->nullable();
            $table->bigInteger('cityId')->unsigned()->nullable();
            $table->string('channel')->default('broadcast');
            $table->integer('orderId')->default(0);
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
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
        Schema::table('weather_subscriptions', function(Blueprint $table) {
            $table->dropForeign('weather_subscriptions_userId_foreign');
            $table->dropForeign('weather_subscriptions_cityId_foreign');
        });

        Schema::dropIfExists('weather_subscriptions');
    }
}
