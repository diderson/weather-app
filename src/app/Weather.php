<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model {

	protected $table = 'weather';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'city_id',
		'latitude',
		'longitude',
		'last_updated',
		'last_updated_epoch',
		'temp_c',
		'temp_f',
		'feelslike_c',
		'feelslike_f',
		'condition_text',
		'condition_icon',
		'condition_code',
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
		'is_day',
		'uv',
		'gust_mph',
		'gust_kph',
		'weather_payload',
	];

	/**
	 * Get the show that owns the booking.
	 */
	public function city() {
		return $this->belongsTo('App\City');
	}
}
