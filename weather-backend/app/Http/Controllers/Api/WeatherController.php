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
        $units = $request->input('units', 'metric'); // default to Celsius

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

        $data = $response->json();

        return response()->json([
            'city' => $data['name'],
            'country' => $data['sys']['country'],
            'description' => $data['weather'][0]['description'],
            'icon' => $data['weather'][0]['icon'],
            'temperature' => $data['main']['temp'],
            'humidity' => $data['main']['humidity'],
            'wind_speed' => $data['wind']['speed'],
            'datetime' => $data['dt'],
        ]);
    }
}
