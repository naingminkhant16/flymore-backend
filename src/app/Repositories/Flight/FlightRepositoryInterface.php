<?php

namespace App\Repositories\Flight;

use App\Exceptions\CustomException;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Collection;

interface FlightRepositoryInterface
{
    /**
     * Create new flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function create(array $data): Flight;

    /**
     * Get flight by flight number
     * @param string $flightNumber
     * @return Flight|null
     */
    public function getByFlightNumber(string $flightNumber): ?Flight;

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
        string $flightNumber,
        int    $departureAirportId,
        int    $arrivalAirportId,
        string $flightDate,
        string $departureTime,
        string $arrivalTime,
    ): bool;

    /**
     * Search flights by departure airport id/ids, arrival airport id/ids and departure date
     * @param int|array $departureAirportId
     * @param int|array $arrivalAirportId
     * @param string $departureDate
     * @return Collection
     */
    public function getByAirportIdsAndDepartureDate(
        int|array $departureAirportId,
        int|array $arrivalAirportId,
        string    $departureDate
    ): Collection;
}
