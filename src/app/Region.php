<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model {

	protected $table = 'regions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug',
		'code',
		'iso_code',
		'country_id',
	];

	/**
	 * Generate a URL friendly string from the brief's slug.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setSlugAttribute($value) {
		$this->attributes['slug'] = Str::slug($value);
	}

	/**
	 * Get the show that owns the booking.
	 */
	public function country() {
		return $this->belongsTo('App\Country');
	}

}
