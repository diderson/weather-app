<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWeather extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            //weather data from payload
            $table->string('last_updated')->nullable();
            $table->string('last_updated_epoch')->nullable();
            $table->string('temp_c')->nullable();
            $table->string('temp_f')->nullable();
            $table->string('feelslike_c')->nullable();
            $table->string('feelslike_f')->nullable();
            $table->string('condition_text')->nullable();
            $table->string('condition_icon')->nullable();
            $table->string('condition_code')->nullable();
            $table->string('wind_mph')->nullable();

            $table->string('wind_kph')->nullable();
            $table->string('wind_degree')->nullable();
            $table->string('wind_dir')->nullable();
            $table->string('pressure_mb')->nullable();
            $table->string('pressure_in')->nullable();
            $table->string('precip_mm')->nullable();
            $table->string('precip_in')->nullable();
            $table->string('humidity')->nullable();
            $table->string('cloud')->nullable();
            $table->string('is_day')->nullable();

            $table->string('uv')->nullable();
            $table->string('gust_mph')->nullable();
            $table->string('gust_kph')->nullable();

            //weather payload that will help to verify if we saved correct dataset
            $table->json('weather_payload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->dropForeign('weather_city_id_foreign');
        });
        Schema::dropIfExists('weather');
    }
}
