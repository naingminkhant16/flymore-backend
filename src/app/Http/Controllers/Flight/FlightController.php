<?php

namespace App\Http\Controllers\Flight;

use App\Enums\FlightStatus;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\FlightCreateRequest;
use App\Http\Resources\Flight\FlightResource;
use App\Http\Responses\ApiResponse;
use App\Models\Flight;
use App\Services\Flight\FlightServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class FlightController extends Controller
{
    public function __construct(private readonly FlightServiceInterface $flightService)
    {
    }

    /**
     * Create a new Flight
     * @param FlightCreateRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function store(FlightCreateRequest $request): JsonResponse
    {
        $flight = $this->flightService->create($request->validated());
        return ApiResponse::success("Flight created.", 201, ['flight' => new FlightResource($flight)]);
    }

    /**
     * Search Flight with Country or Code or name of airport or City
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
                'from' => 'required|string',
                'to' => 'required|string',
                'date' => 'required|date_format:Y-m-d']
        );

        $flights = $this->flightService->searchByFromToAndDepartureDate(
            $request->from,
            $request->to,
            $request->date
        );

        return ApiResponse::success(
            message: 'Available flights found.',
            data: ['flights' => FlightResource::collection($flights)]
        );
    }

    /**
     * Update the flight status
     * @param Flight $flight
     * @param Request $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function updateStatus(Flight $flight, Request $request): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'string', new Enum(FlightStatus::class)],
        ]);

        $flight = $this->flightService->updateFlightStatus($flight, $request->input('status'));

        return ApiResponse::success(
            message: 'Flight status updated.',
            data: ['flight' => new FlightResource($flight)]
        );
    }

    /**
     * Endpoint for available flight status
     * @return JsonResponse
     */
    public function status(): JsonResponse
    {
        return ApiResponse::success(
            message: 'Available Flight Status.',
            data: ['flight_status' => FlightStatus::values()]
        );
    }
}
