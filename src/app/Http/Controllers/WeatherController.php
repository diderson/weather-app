<?php

namespace App\Http\Controllers;

use App\Weather\Repositories\Eloquent\WeatherEloquentRepository;

class WeatherController extends Controller {
	private $weatherRepository;

	public function __construct(WeatherEloquentRepository $weatherRepository) {
		$this->weatherRepository = $weatherRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$weather = [];
		$weather = $this->weatherRepository->currentWeather();
		$weather_latest = $this->weatherRepository->findLatest(5);

		return view('home', compact('weather', 'weather_latest'));
	}
}
