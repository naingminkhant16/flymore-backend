<?php

namespace App\Services\Flight;

use App\Enums\FlightStatus;
use App\Exceptions\CustomException;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Collection;

interface FlightServiceInterface
{
    /**
     * Create a flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function create(array $data): Flight;

    /**
     *  Search flights by From - To Airports with keyword (Airport - name, code, city, or country)
     *  And Departure Date
     * @param string $from
     * @param string $to
     * @param string $departureDate
     * @return Collection|null
     */
    public function searchByFromToAndDepartureDate(string $from, string $to, string $departureDate): ?Collection;

    /**
     * Update flight status
     * @param Flight $flight
     * @param FlightStatus $flightStatus
     * @return Flight
     * @throws CustomException
     */
    public function updateFlightStatus(Flight $flight, FlightStatus $flightStatus): Flight;
}
