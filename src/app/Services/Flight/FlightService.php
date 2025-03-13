<?php

namespace App\Services\Flight;

use App\Exceptions\CustomException;
use App\Models\Flight;
use App\Repositories\Flight\FlightRepositoryInterface;

readonly class FlightService implements FlightServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly FlightRepositoryInterface $flightRepository)
    {
    }

    /**
     * Create a flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function create(array $data): Flight
    {
        // Check duplicated flight with same flight number, date and time
        if ($this->flightRepository->checkFlightExists(
            $data['flight_number'],
            $data['departure_airport_id'],
            $data['arrival_airport_id'],
            $data['flight_date'],
            $data['departure_time'],
            $data['arrival_time'],
        )) {
            throw new CustomException("Flight already exists!", 400);
        }
        return $this->flightRepository->create($data);
    }
}
