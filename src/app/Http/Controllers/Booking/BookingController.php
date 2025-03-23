<?php

namespace App\Http\Controllers\Booking;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingCreateRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Booking\BookingServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(private readonly BookingServiceInterface $bookingService)
    {
    }

    /**
     * Make a booking
     * @param BookingCreateRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function makeBooking(BookingCreateRequest $request): JsonResponse
    {
        $bookingResource = $this->bookingService->makeBooking($request->validated());
        return ApiResponse::success(
            "Booking created successfully",
            201,
            ['booking' => $bookingResource]
        );
    }
}
