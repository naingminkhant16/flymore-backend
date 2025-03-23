<?php

namespace App\Repositories\Passenger;

use App\Models\Passenger;

interface PassengerRepositoryInterface
{
    /**
     * Create a passenger
     * @param array $data
     * @return Passenger
     * @throws \App\Exceptions\CustomException
     */
    public function create(array $data): Passenger;
}
