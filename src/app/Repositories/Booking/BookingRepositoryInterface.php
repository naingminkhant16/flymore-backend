<?php

namespace App\Repositories\Booking;

use App\Exceptions\CustomException;
use App\Models\Booking;

interface BookingRepositoryInterface
{
    /**
     * Create new booking
     * @param array $data
     * @return Booking
     * @throws CustomException
     */
    public function create(array $data): Booking;
}
