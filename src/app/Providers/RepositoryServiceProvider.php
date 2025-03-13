<?php

namespace App\Providers;

use App\Repositories\Airline\AirlineRepository;
use App\Repositories\Airline\AirlineRepositoryInterface;
use App\Repositories\Airport\AirportRepository;
use App\Repositories\Airport\AirportRepositoryInterface;
use App\Repositories\Flight\FlightRepositoryInterface;
use App\Repositories\Flight\FlightRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AirlineRepositoryInterface::class, AirlineRepository::class);
        $this->app->bind(AirportRepositoryInterface::class, AirportRepository::class);
        $this->app->bind(FlightRepositoryInterface::class, FlightRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
