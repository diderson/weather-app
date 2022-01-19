<?php

namespace App\Weather\Repositories\Eloquent;

use App\Weather;
use App\Weather\Interfaces\WeatherRepositoryInterface;

class WeatherEloquentRepository implements WeatherRepositoryInterface {

	public function currentWeather() {
		return Weather::with('city')->latest()->first();
	}
	public function findLatest($limit = 5) {
		return Weather::latest()->take($limit)->get();
	}

	public function store($data) {}
}