<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model {

	protected $table = 'countries';

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
	 *  Get the cities
	 */
	public function cities() {
		return $this->hasMany('App\City');
	}

	public function regions() {
		return $this->hasMany('App\Region');
	}
}
