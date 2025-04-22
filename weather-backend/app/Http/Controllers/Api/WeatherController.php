<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
{
    $city = $request->input('city');
    $units = $request->input('units', 'metric');

    if (!$city) {
        return response()->json(['error' => 'City is required'], 400);
    }

    $apiKey = env('OPENWEATHER_API_KEY');

    $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
        'q' => $city,
        'appid' => $apiKey,
        'units' => $units
    ]);

    \Log::info('Weather API response', [
        'status' => $response->status(),
        'body' => $response->body()
    ]);

    if ($response->failed()) {
        return response()->json([
            'error' => 'Failed to fetch weather data',
            'details' => $response->json()
        ], 500);
    }

    return response()->json($response->json());
}

}
