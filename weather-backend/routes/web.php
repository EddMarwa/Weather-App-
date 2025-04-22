<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

// Weather API endpoint
Route::get('/api/weather', [WeatherController::class, 'getWeather']);
