<?php

use App\Http\Controllers\Airline\AirlineController;
use App\Http\Controllers\Airport\AirportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Flight\FlightController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Country\CountryController;
use App\Http\Middleware\IsSystemAdmin;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', IsSystemAdmin::class])->group(function () {
    // Airline Routes
    ROute::get('/airlines', [AirlineController::class, 'index']);
    Route::post('/airlines', [AirlineController::class, 'store']);
    Route::put('/airlines/{airline}', [AirlineController::class, 'update']);

    // Airport Routes
    Route::get('/airports', [AirportController::class, 'index']);
    Route::post('/airports', [AirportController::class, 'store']);
    Route::put('/airports/{airport}', [AirportController::class, 'update']);

    // Flight Routes
    Route::post('/flights', [FlightController::class, 'store']);
    Route::get('/flights/search', [FlightController::class, 'search']);
});
// Country List
Route::get('/countries', [CountryController::class, 'countryList']);
