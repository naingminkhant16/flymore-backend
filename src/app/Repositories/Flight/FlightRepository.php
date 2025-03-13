<?php

namespace App\Repositories\Flight;

use App\Exceptions\CustomException;
use App\Models\Flight;
use Illuminate\Support\Facades\Log;

readonly class FlightRepository implements FlightRepositoryInterface
{
    public function __construct(private readonly Flight $flight)
    {
    }

    /**
     * Create new flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function create(array $data): Flight
    {
        try {
            return $this->flight->create([
                'flight_number' => $data['flight_number'],
                'airline_id' => $data['airline_id'],
                'departure_airport_id' => $data['departure_airport_id'],
                'arrival_airport_id' => $data['arrival_airport_id'],
                'departure_time' => $data['departure_time'],
                'arrival_time' => $data['arrival_time'],
                'flight_date' => $data['flight_date'],
                'price' => $data['price'],
                'allowed_kg' => $data['allowed_kg'],
                'available_seats' => $data['available_seats'],
            ]);
        } catch (\Exception $exception) {
            Log::error("FlightRepository::create(): Failed to create flight: {$exception->getMessage()}");
            throw new CustomException("Internal Server Error");
        }
    }

    /**
     * Get flight by flight number
     * @param string $flightNumber
     * @return Flight|null
     */
    public function getByFlightNumber(string $flightNumber): ?Flight
    {
        return $this->flight->where('flight_number', $flightNumber)->first();
    }

    /**
     * Check if flight already exists
     * @param string $flightNumber
     * @param int $departureAirportId
     * @param int $arrivalAirportId
     * @param string $flightDate
     * @param string $departureTime
     * @param string $arrivalTime
     * @return bool
     */
    public function checkFlightExists(
        string $flightNumber, int $departureAirportId,
        int    $arrivalAirportId, string $flightDate,
        string $departureTime, string $arrivalTime
    ): bool
    {
        return $this->flight->where('flight_number', $flightNumber)
            ->where('departure_airport_id', $departureAirportId)
            ->where('arrival_airport_id', $arrivalAirportId)
            ->where('flight_date', $flightDate)
            ->where('departure_time', $departureTime)
            ->where('arrival_time', $arrivalTime)
            ->exists();
    }
}
