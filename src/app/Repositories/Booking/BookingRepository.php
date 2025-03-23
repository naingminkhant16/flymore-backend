<?php

namespace App\Repositories\Booking;

use App\Exceptions\CustomException;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

readonly class BookingRepository implements BookingRepositoryInterface
{
    public function __construct(private Booking $booking)
    {
    }

    /**
     * Create new booking
     * @param array $data
     * @return Booking
     * @throws CustomException
     */
    public function create(array $data): Booking
    {
        try {
            return $this->booking->create([
                'flight_id' => $data['flight_id'],
                'booked_by' => $data['booked_by'],
                'booked_email' => $data['booked_email'],
                'booked_phone' => $data['booked_phone'],
            ]);
        } catch (\Exception $e) {
            Log::error("BookingRepository::create(): Failed to create booking: {$e->getMessage()}");
            throw new CustomException($e->getMessage());
        }
    }
}
