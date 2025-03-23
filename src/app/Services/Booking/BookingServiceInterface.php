<?php

namespace App\Services\Booking;

use App\Exceptions\CustomException;
use App\Http\Resources\Booking\BookingResource;

interface BookingServiceInterface
{
    /**
     * Make a booking
     * @param array $data
     * @return BookingResource
     * @throws CustomException
     */
    public function makeBooking(array $data): BookingResource;
}
