<?php

namespace App\Repositories\Airport;

use App\Exceptions\InternalServerErrorException;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Collection;

interface AirportRepositoryInterface
{
    /**
     * Get All Airports
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $data
     * @return Airport
     * @throws InternalServerErrorException
     */
    public function create(array $data): Airport;

    /**
     * @param Airport $airport
     * @param array $data
     * @return Airport
     * @throws InternalServerErrorException
     */
    public function update(Airport $airport, array $data): Airport;
}
