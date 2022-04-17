<?php

namespace App\Listeners;

use App\Events\LoggedIn;
use App\Http\Traits\UnitConversionTrait;
use App\Models\CityTemperature;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class RetrieveCurrentTemperature
{
    use UnitConversionTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LoggedIn $event)
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoggedIn  $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {
        $api_baseurl = config('openweathermap.api_baseurl');
        $cities = config('openweathermap.cities');
        $api_key = config('openweathermap.api_key');
        $user = $event->user;


        if (!empty($cities)) {
            foreach ($cities as $key => $value) {

                // call weather map API
                $response = Http::get($api_baseurl . '/data/2.5/onecall', [
                    'lat' => $value['lat'],
                    'lon' => $value['lon'],
                    'exclude' => 'minutely,hourly,daily,alerts',
                    'units' => 'metric',
                    'appid' => $api_key
                ]);

                if ($response->successful() && isset($response->object()->current->temp)) {
                    // response object
                    $res_obj = $response->object();

                    // convert celsius to fahrenheit
                    $tempFahrenheit = isset($res_obj->current->temp) ? $this->celsiusToFahrenheit($res_obj->current->temp) : NULL;

                    // save temperature dataset
                    CityTemperature::create([
                        'user_id' => $user->id,
                        'city_slug' => $value['slug'],
                        'temp_c' => $res_obj->current->temp ?? NULL,
                        'temp_f' => $tempFahrenheit,
                    ]);
                }
            }
        }
    }
}
