<?php

namespace App\Services\Booking;

use App\Exceptions\CustomException;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\Booking\BookingResource;

interface BookingServiceInterface
{
    /**
     * Make a booking
     * @param array $data
     * @return BookingResource
     * @throws CustomException|ResourceNotFoundException
     */
    public function makeBooking(array $data): BookingResource;
}
