<?php

namespace App\Repositories\Airport;

use App\Exceptions\CustomException;
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
     * @throws CustomException
     */
    public function create(array $data): Airport;

    /**
     * @param Airport $airport
     * @param array $data
     * @return Airport
     * @throws CustomException
     */
    public function update(Airport $airport, array $data): Airport;

    /**
     * Search by keyword (name, code, city, country)
     * @param string $keyword
     * @return Collection
     */
    public function getByKeyword(string $keyword): Collection;
}
