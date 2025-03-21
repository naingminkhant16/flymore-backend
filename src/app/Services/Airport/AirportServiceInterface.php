<?php

namespace App\Services\Airport;

use App\Exceptions\CustomException;
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
     * Create airport
     * @param array $data
     * @return Airport
     * @throws CustomException
     */
    public function create(array $data): Airport;

    /**
     * Update airport
     * @param Airport $airport
     * @param array $data
     * @return Airport
     * @throws CustomException
     */
    public function update(Airport $airport, array $data): Airport;
}
