<?php

namespace App\Services\Booking;

use App\Exceptions\CustomException;
use App\Exceptions\ResourceNotFoundException;
use App\Facade\BookingManagementFacade;
use App\Http\Resources\Booking\BookingResource;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Flight\FlightRepositoryInterface;
use App\Repositories\Passenger\PassengerRepositoryInterface;

readonly class BookingService implements BookingServiceInterface
{
    private BookingManagementFacade $bookingManagementFacade;

    public function __construct(
        private BookingRepositoryInterface   $bookingRepository,
        private PassengerRepositoryInterface $passengerRepository,
        private FlightRepositoryInterface    $flightRepository,
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
     * @throws CustomException|ResourceNotFoundException
     */
    public function makeBooking(array $data): BookingResource
    {
        $flight = $this->flightRepository->getById($data['flight_id']);

        if ($flight->available_seats < count($data['passengers'])) {
            throw new CustomException(
                "Exceed the maximum number of passengers available",
                400
            );
        }

        return $this->bookingManagementFacade->makeBooking($data);
    }
}
