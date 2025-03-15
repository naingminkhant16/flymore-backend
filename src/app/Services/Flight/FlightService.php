<?php

namespace App\Services\Flight;

use App\Enums\FlightStatus;
use App\Exceptions\CustomException;
use App\Models\Flight;
use App\Repositories\Airport\AirportRepositoryInterface;
use App\Repositories\Flight\FlightRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class FlightService implements FlightServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly FlightRepositoryInterface  $flightRepository,
        private readonly AirportRepositoryInterface $airportRepository)
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
        $this->checkFlightExists($data);

        return $this->flightRepository->create($data);
    }

    /**
     * Check flight already exists before create or update
     * @param array $data
     * @return void
     * @throws CustomException
     */
    private function checkFlightExists(array $data): void
    {
        $id = empty($data['id']) ? null : $data['id'];
        logger($id);
        if ($this->flightRepository->checkFlightExists(
            $data['flight_number'],
            $data['departure_airport_id'],
            $data['arrival_airport_id'],
            $data['flight_date'],
            $data['departure_time'],
            $data['arrival_time'],
            $id
        )) throw new CustomException("Flight already exists!", 400);
    }

    /**
     *  Search flights by From - To Airports with keyword (Airport - name, code, city, or country)
     *  And Departure Date
     * @param string $from
     * @param string $to
     * @param string $departureDate
     * @return Collection|null
     */
    public function searchByFromToAndDepartureDate(string $from, string $to, string $departureDate): ?Collection
    {
        // Get From Airport Ids
        $fromAirports = $this->airportRepository->getByKeyword($from)->pluck('id')->toArray();
        // Get To Airport Ids
        $toAirports = $this->airportRepository->getByKeyword($to)->pluck('id')->toArray();

        // Search Flights
        return $this->flightRepository->getByAirportIdsAndDepartureDate(
            $fromAirports, $toAirports, $departureDate
        );
    }

    /**
     * Update flight status
     * @param Flight $flight
     * @param string $flightStatus
     * @return Flight
     * @throws CustomException
     */
    public function updateFlightStatus(Flight $flight, string $flightStatus): Flight
    {
        return $this->flightRepository->updateFlightStatus($flight, FlightStatus::tryFrom($flightStatus));
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
        $data['status'] = FlightStatus::tryFrom($data['status']); // Convert to enum
        $data['id'] = $flight->id; // to check duplication excepts itself
        $this->checkFlightExists($data);
        return $this->flightRepository->update($flight, $data);
    }
}
