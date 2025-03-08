<?php

namespace App\Repositories\Airline;

use App\Models\Airline;
use Illuminate\Database\Eloquent\Collection;

interface AirlineRepositoryInterface
{
    /**
     * Get All Airlines
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $data
     * @return Airline
     */
    public function create(array $data): Airline;

    /**
     * @param Airline $airline
     * @param array $data
     * @return Airline
     */
    public function update(Airline $airline, array $data): Airline;
}
