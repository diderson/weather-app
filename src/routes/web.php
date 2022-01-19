<?php

use Illuminate\Support\Facades\Route;

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
	return view('home');
});

Route::get('/', 'WeatherController@index');

Route::get('/weatherTest', function () {
	$response = Http::get(env('WEATHER_API_URL') . '?key=' . env('WEATHER_API_KEY') . '&q=Montreal&aqi=no');

	return $response->json();
});
