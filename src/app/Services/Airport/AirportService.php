<?php

namespace App\Services\Airport;

use App\Exceptions\CustomException;
use App\Models\Airport;
use App\Repositories\Airport\AirportRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class AirportService implements AirportServiceInterface
{
    public function __construct(private AirportRepositoryInterface $airportRepository)
    {
    }

    /**
     * Get All Airports
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->airportRepository->getAll();
    }

    /**
     * @param array $data
     * @return Airport
     * @throws CustomException
     */
    public function create(array $data): Airport
    {
        return $this->airportRepository->create($data);
    }

    /**
     * Update airport
     * @param Airport $airport
     * @param array $data
     * @return Airport
     * @throws CustomException
     */
    public function update(Airport $airport, array $data): Airport
    {
        return $this->airportRepository->update($airport, $data);
    }
}
