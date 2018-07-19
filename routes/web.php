<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function() {
    Route::resources([
        'cities' => 'CityController'
    ]);

    Route::get('/cities/search/{$query}', 'CityController@search')->name('cities.search');

    Route::get('/weather/subscribe/{city}', 'WeatherSubscriptionController@subscribe')->name('weather.subscribe');
    Route::get('/weather/unsubscribe/{city}', 'WeatherSubscriptionController@search')->name('weather.unsubscribe');
    Route::get('/weather/subscriptions', 'WeatherSubscriptionController@index')->name('weather.subscriptions');
});