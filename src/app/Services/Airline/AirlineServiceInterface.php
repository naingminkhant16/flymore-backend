<?php

namespace App\Services\Airline;

use App\Models\Airline;

interface AirlineServiceInterface
{
    /**
     * @param array $data
     * @return Airline
     */
    public function create(array $data): Airline;
}
