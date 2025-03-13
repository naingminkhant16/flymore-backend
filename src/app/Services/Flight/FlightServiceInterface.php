<?php

namespace App\Services\Flight;

use App\Exceptions\CustomException;
use App\Models\Flight;

interface FlightServiceInterface
{
    /**
     * Create a flight
     * @param array $data
     * @return Flight
     * @throws CustomException
     */
    public function create(array $data): Flight;
}
