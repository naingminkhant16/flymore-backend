<?php

namespace App\Providers;

use App\Services\Airline\AirlineService;
use App\Services\Airline\AirlineServiceInterface;
use App\Services\Airport\AirportService;
use App\Services\Airport\AirportServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Flight\FlightService;
use App\Services\Flight\FlightServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(AirlineServiceInterface::class, AirlineService::class);
        $this->app->bind(AirportServiceInterface::class, AirportService::class);
        $this->app->bind(FlightServiceInterface::class, FlightService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
