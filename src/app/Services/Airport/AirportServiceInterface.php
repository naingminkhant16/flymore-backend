<?php

namespace App\Services\Airport;

use App\Exceptions\InternalServerErrorException;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Collection;

interface AirportServiceInterface
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
}
