<?php

namespace App\Services\Booking;

use App\Exceptions\CustomException;
use App\Facade\BookingManagementFacade;
use App\Http\Resources\Booking\BookingResource;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Passenger\PassengerRepositoryInterface;

readonly class BookingService implements BookingServiceInterface
{
    private BookingManagementFacade $bookingManagementFacade;

    public function __construct(
        private BookingRepositoryInterface   $bookingRepository,
        private PassengerRepositoryInterface $passengerRepository
    )
    {
        $this->bookingManagementFacade = new BookingManagementFacade(
            $this->bookingRepository,
            $this->passengerRepository
        );
    }

    /**
     * Make a booking
     * @param array $data
     * @return BookingResource
     * @throws CustomException
     */
    public function makeBooking(array $data): BookingResource
    {
        // TODO : Check available seats with provided passengers
        return $this->bookingManagementFacade->makeBooking($data);
    }
}
