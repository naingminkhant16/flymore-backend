<?php

namespace App\Http\Controllers\Flight;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\FlightCreateRequest;
use App\Http\Resources\Flight\FlightResource;
use App\Http\Responses\ApiResponse;
use App\Models\Flight;
use App\Services\Flight\FlightServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function __construct(private readonly FlightServiceInterface $flightService)
    {
    }

    /**
     * @param FlightCreateRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function store(FlightCreateRequest $request): JsonResponse
    {
        $flight = $this->flightService->create($request->validated());
        return ApiResponse::success("Flight created.", 201, ['flight' => $flight]);
    }

    public function search(Request $request)
    {
        $flights = $this->flightService->searchByFromToAndDepartureDate(
            $request->from,
            $request->to,
            $request->date
        );

        return ApiResponse::success(message: 'Available flights found.', data: ['flights' => FlightResource::collection($flights)]);
    }
}
