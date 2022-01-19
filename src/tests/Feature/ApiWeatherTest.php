<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class ApiWeatherTest extends TestCase {
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 * @group testExample
	 */
	public function testExample() {
		$response = $this->get('/');

		$response->assertStatus(Response::HTTP_OK);
	}

	/**
	 * [testGettingWeatherData description]
	 * @group testGettingWeatherData
	 */
	public function testGettingWeatherData() {

		$this->json('GET', '/weatherTest', ['Accept' => 'application/json'])
			->assertStatus(Response::HTTP_OK)
			->assertJsonStructure(
				[
					'location' => [
						'name',
						'region',
						'country',
						'lat',
						'lon',
						'tz_id',
						'localtime_epoch',
						'localtime',
					],
					'current' => [
						'last_updated_epoch',
						'last_updated',
						'temp_c',
						'temp_f',
						'is_day',
						'condition' => [
							'text',
							'icon',
							'code',
						],
						'wind_mph',
						'wind_kph',
						'wind_degree',
						'wind_dir',
						'pressure_mb',
						'pressure_in',
						'precip_mm',
						'precip_in',
						'humidity',
						'cloud',
						'feelslike_c',
						'feelslike_f',
						'vis_km',
						'vis_miles',
						'uv',
						'gust_mph',
						'gust_kph',
					],
				]
			)
			->assertJson(
				[
					'location' => [
						'name' => 'Montreal',
						'region' => 'Quebec',
						'country' => 'Canada',
					],
				]
			);
	}
}
