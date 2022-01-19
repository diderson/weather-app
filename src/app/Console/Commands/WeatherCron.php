<?php

namespace App\Console\Commands;

use App\City;
use App\Country;
use App\Region;
use App\Weather;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class WeatherCron extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'weather:cron {city}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Getting weather for cities';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		$client = new Client();
		$request = $client->get('http://api.weatherapi.com/v1/current.json?key=' . env('WEATHER_API_KEY') . '&q=' . $this->argument('city') . '&aqi=no');

		$response = $request->getBody()->getContents();
		$weather_data = json_decode($response, true);

		$city_name = $this->argument('city');

		$weather = [];
		$region = [];
		$city = [];
		$country = [];

		//Region
		//City
		//Weather

		//Save or update existing Country
		$country['name'] = (isset($weather_data['location']['country'])) ? $weather_data['location']['country'] : '';
		$country['slug'] = (!empty($country['name'])) ? Str::slug($country['name']) : '';

		$countryModel = Country::updateOrCreate(['slug' => $country['slug']], $country);

		//Save or update existing Region
		$region['name'] = (isset($weather_data['location']['region'])) ? $weather_data['location']['region'] : '';
		$region['slug'] = (!empty($region['name'])) ? Str::slug($region['name']) : '';

		$regionModel = Region::updateOrCreate(['slug' => $region['slug']], $region);

		//Save or update existing City
		$city['country_id'] = '';
		if ($countryModel) {
			$city['country_id'] = $countryModel->id;
		}

		$city['region_id'] = '';
		if ($regionModel) {
			$city['region_id'] = $regionModel->id;
		}

		$city['name'] = (isset($weather_data['location']['name'])) ? $weather_data['location']['name'] : '';
		$city['slug'] = (!empty($city['name'])) ? Str::slug($city['name']) : '';

		$cityModel = City::updateOrCreate(['slug' => $city['slug']], $city);

		//Save or update existing Weather data
		$weather['city_id'] = '';
		if ($cityModel) {
			$weather['city_id'] = $regionModel->id;
		}
		$weather['latitude'] = (isset($weather_data['location']['lat'])) ? $weather_data['location']['lat'] : '';
		$weather['longitude'] = (isset($weather_data['location']['lon'])) ? $weather_data['location']['lon'] : '';

		$weather['last_updated'] = (isset($weather_data['current']['last_updated'])) ? $weather_data['current']['last_updated'] : '';
		$weather['last_updated_epoch'] = (isset($weather_data['current']['last_updated_epoch'])) ? $weather_data['current']['last_updated_epoch'] : '';
		$weather['temp_c'] = (isset($weather_data['current']['temp_c'])) ? $weather_data['current']['temp_c'] : '';
		$weather['temp_f'] = (isset($weather_data['current']['temp_f'])) ? $weather_data['current']['temp_f'] : '';
		$weather['feelslike_c'] = (isset($weather_data['current']['feelslike_c'])) ? $weather_data['current']['feelslike_c'] : '';
		$weather['feelslike_f'] = (isset($weather_data['current']['feelslike_f'])) ? $weather_data['current']['feelslike_f'] : '';
		$weather['condition_text'] = (isset($weather_data['current']['condition'])) ? $weather_data['current']['condition']['text'] : '';
		$weather['condition_icon'] = (isset($weather_data['current']['condition'])) ? $weather_data['current']['condition']['icon'] : '';
		$weather['condition_code'] = (isset($weather_data['current']['condition'])) ? $weather_data['current']['condition']['code'] : '';
		$weather['wind_mph'] = (isset($weather_data['current']['wind_mph'])) ? $weather_data['current']['wind_mph'] : '';
		$weather['wind_kph'] = (isset($weather_data['current']['wind_kph'])) ? $weather_data['current']['wind_kph'] : '';
		$weather['wind_degree'] = (isset($weather_data['current']['wind_degree'])) ? $weather_data['current']['wind_degree'] : '';
		$weather['wind_dir'] = (isset($weather_data['current']['wind_dir'])) ? $weather_data['current']['wind_dir'] : '';
		$weather['pressure_mb'] = (isset($weather_data['current']['pressure_mb'])) ? $weather_data['current']['pressure_mb'] : '';
		$weather['pressure_in'] = (isset($weather_data['current']['pressure_in'])) ? $weather_data['current']['pressure_in'] : '';
		$weather['precip_mm'] = (isset($weather_data['current']['precip_mm'])) ? $weather_data['current']['precip_mm'] : '';
		$weather['precip_in'] = (isset($weather_data['current']['precip_in'])) ? $weather_data['current']['precip_in'] : '';
		$weather['humidity'] = (isset($weather_data['current']['humidity'])) ? $weather_data['current']['humidity'] : '';
		$weather['cloud'] = (isset($weather_data['current']['cloud'])) ? $weather_data['current']['cloud'] : '';
		$weather['is_day'] = (isset($weather_data['current']['is_day'])) ? $weather_data['current']['is_day'] : '';
		$weather['uv'] = (isset($weather_data['current']['uv'])) ? $weather_data['current']['uv'] : '';
		$weather['gust_mph'] = (isset($weather_data['current']['gust_mph'])) ? $weather_data['current']['gust_mph'] : '';
		$weather['gust_kph'] = (isset($weather_data['current']['gust_kph'])) ? $weather_data['current']['gust_kph'] : '';
		$weather['weather_payload'] = json_encode($weather_data);

		$weatherModel = Weather::updateOrCreate(['city_id' => $weather['city_id'], 'last_updated' => $weather['last_updated']], $weather);

		$this->info("Saving weather info for: {$city_name}!");

	}
}
