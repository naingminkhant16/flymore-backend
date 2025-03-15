<?php

use App\Http\Controllers\Airline\AirlineController;
use App\Http\Controllers\Airport\AirportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Flight\FlightController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Country\CountryController;
use App\Http\Middleware\IsSystemAdmin;

Route::post('/login', [AuthController::class, 'login']);
// Admin Routes
Route::middleware(['auth:sanctum', IsSystemAdmin::class])->group(function () {
    // Airline Routes
    ROute::get('/airlines', [AirlineController::class, 'index']); // get all airlines
    Route::post('/airlines', [AirlineController::class, 'store']); // store a new airline
    Route::put('/airlines/{airline}', [AirlineController::class, 'update']); // update airline

    // Airport Routes
    Route::get('/airports', [AirportController::class, 'index']); // get all airports
    Route::post('/airports', [AirportController::class, 'store']); // store a new airport
    Route::put('/airports/{airport}', [AirportController::class, 'update']); // update airport

    // Flight Routes
    Route::post('/flights', [FlightController::class, 'store']); // Store a new flight
    Route::patch('/flights/{flight}/status', [FlightController::class, 'updateStatus']);// Change Flight Status
    Route::put('/flights/{flight}', [FlightController::class, 'update']); // Update flight
});

// Public Routes
// Flight Search Route
Route::get('/flights/search', [FlightController::class, 'search']);
// Flight status'
Route::get('/flights/status', [FlightController::class, 'status']);
// Country List
Route::get('/countries', [CountryController::class, 'countryList']);

