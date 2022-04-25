<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\GetCityTempRequest;
use App\Api\V1\Resources\CityTempCollection;
use App\Http\Controllers\Controller;
use App\Models\CityTemperature;
use Illuminate\Http\Request;

class CityTempController extends Controller
{
    public function getCityTemperatures(GetCityTempRequest $request)
    {
        try {
            $cityTempData = CityTemperature::where('user_id', auth()->user()->id)
                ->where('city_slug', $request->city_slug)
                ->orderBy($request->sort_by, 'DESC')
                ->paginate(3);

            return response()->json(new CityTempCollection($cityTempData));
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!'
            ], 561);
        }
    }

    public function getCities()
    {
        try {
            $cities = config('openweathermap.cities');

            return response()->json([
                'status' => 'success',
                'data' => $cities,
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!'
            ], 561);
        }
    }
}
