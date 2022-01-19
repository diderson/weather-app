<?php

namespace App\Weather\Interfaces;

interface WeatherRepositoryInterface {

	public function currentWeather();

	public function findLatest($limit = 5);

	public function store($data);

}