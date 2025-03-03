<?php

namespace App\Repositories\Airline;

use App\Models\Airline;

interface AirlineRepositoryInterface
{
    /**
     * @param array $data
     * @return Airline
     */
    public function create(array $data): Airline;
}
