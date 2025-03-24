<?php

namespace App\Facade;

use App\Exceptions\CustomException;
use App\Http\Resources\Booking\BookingResource;
use App\Jobs\GenerateETicketPdfJob;
use App\Mail\BookingMade;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Passenger\PassengerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

readonly class BookingManagementFacade
{
    public function __construct(
        private BookingRepositoryInterface   $bookingRepository,
        private PassengerRepositoryInterface $passengerRepository
    )
    {
    }

    /**
     * @param array $data
     * @return BookingResource
     * @throws CustomException
     */
    public function makeBooking(array $data): BookingResource
    {
        DB::beginTransaction();
        try {
            // Create Booking
            $booking = $this->bookingRepository->create($data);

            // Create Passengers
            foreach ($data['passengers'] as $passengerData) {
                $passengerData['booking_id'] = $booking->id;
                $this->passengerRepository->create($passengerData);
            }

            // Generate PDF
            GenerateETicketPdfJob::dispatch($booking);

            // Send Email with PDF
            Mail::to($booking->booked_email)->queue(new BookingMade($booking));

            DB::commit();
            return new BookingResource($booking);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("BookingManagementFacade::makeBooking(): Failed to make booking: {$e->getMessage()}");
            throw new CustomException($e->getMessage());
        }
    }
}
