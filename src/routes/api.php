<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Country\CountryController;
use App\Http\Middleware\IsSystemAdmin;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', IsSystemAdmin::class])->group(function () {
    // Airline
    Route::resource('/airlines', App\Http\Controllers\Airline\AirlineController::class);
});
// Country List
Route::get('/countries', [CountryController::class, 'countryList']);
