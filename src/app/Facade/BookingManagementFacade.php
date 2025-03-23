<?php

namespace App\Facade;

use App\Exceptions\CustomException;
use App\Http\Resources\Booking\BookingResource;
use App\Mail\BookingMade;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Passenger\PassengerRepositoryInterface;
use App\Services\IntegratedServices\PDF\PdfService;
use App\Services\IntegratedServices\PDF\PdfServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

readonly class BookingManagementFacade
{
    private PdfServiceInterface $pdfService;

    public function __construct(
        private BookingRepositoryInterface   $bookingRepository,
        private PassengerRepositoryInterface $passengerRepository
    ) {
        $this->pdfService = new PdfService();
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
            $filePath = $this->pdfService->generateETicket($booking);

            // Send Email with PDF
            Mail::to($booking->booked_email)->send(new BookingMade($booking, $filePath));

            DB::commit();
            return new BookingResource($booking);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("BookingManagementFacade::makeBooking(): Failed to make booking: {$e->getMessage()}");
            throw new CustomException($e->getMessage());
        }
    }
}
