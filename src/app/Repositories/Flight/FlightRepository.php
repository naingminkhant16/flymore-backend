<?php

namespace App\Repositories\Flight;

use App\Enums\FlightStatus;
use App\Exceptions\CustomException;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

readonly class FlightRepository implements FlightRepositoryInterface
{
    public function __construct(private Flight $flight)
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
     * @param int|null $id (for update purpose, exclude itself checking)
     * @return bool
     */
    public function checkFlightExists(
        string $flightNumber, int $departureAirportId,
        int    $arrivalAirportId, string $flightDate,
        string $departureTime, string $arrivalTime, int $id = null
    ): bool
    {
        return $this->flight->where('flight_number', $flightNumber)
            ->where('departure_airport_id', $departureAirportId)
            ->where('arrival_airport_id', $arrivalAirportId)
            ->where('flight_date', $flightDate)
            ->where('departure_time', $departureTime)
            ->where('arrival_time', $arrivalTime)
            ->when($id !== null, fn($query) => $query->where('id', '!=', $id)) // if id is provided, it will exclude itself (for update purpose)
            ->exists();
    }

    /**
     * Search flights by departure airport id/ids, arrival airport id/ids and departure date
     * @param int|array $departureAirportId
     * @param int|array $arrivalAirportId
     * @param string $departureDate
     * @return Collection
     */
    public function getByAirportIdsAndDepartureDate(
        array|int $departureAirportId,
        array|int $arrivalAirportId,
        string    $departureDate
    ): Collection
    {
        $query = $this->flight;
        $query = is_array($departureAirportId)
            ? $query->whereIn('departure_airport_id', $departureAirportId)
            : $query->where('departure_airport_id', $departureAirportId);

        $query = is_array($arrivalAirportId)
            ? $query->whereIn('arrival_airport_id', $arrivalAirportId)
            : $query->where('arrival_airport_id', $arrivalAirportId);

        return $query->where('flight_date', $departureDate)->latest()->get();
    }

    /**
     * Update flight status
     * @param Flight $flight
     * @param FlightStatus $flightStatus
     * @return Flight
     * @throws CustomException
     */
    public function updateFlightStatus(Flight $flight, FlightStatus $flightStatus): Flight
    {
        try {
            $flight->status = $flightStatus;
            $flight->save();
            return $flight;
        } catch (\Exception $exception) {
            Log::error("FlightRepository::updateFlightStatus(): {$exception->getMessage()}");
            throw new CustomException("Internal Server Error");
        }
    }

    /**
     * Update flight
     * @param Flight $flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function update(Flight $flight, array $data): Flight
    {
        try {
            $flight->update([
                'flight_number' => $data['flight_number'],
                'airline_id' => $data['airline_id'],
                'departure_airport_id' => $data['departure_airport_id'],
                'arrival_airport_id' => $data['arrival_airport_id'],
                'departure_time' => $data['departure_time'],
                'arrival_time' => $data['arrival_time'],
                'flight_date' => $data['flight_date'],
                'price' => $data['price'],
                'status' => $data['status'],
                'allowed_kg' => $data['allowed_kg'],
                'available_seats' => $data['available_seats'],
            ]);
            return $flight;
        } catch (\Exception $exception) {
            Log::error("FlightRepository::updateFlight(): {$exception->getMessage()}");
            throw new CustomException("Internal Server Error");
        }
    }
}
