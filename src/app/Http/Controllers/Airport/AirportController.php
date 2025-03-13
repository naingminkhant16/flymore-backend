<?php

namespace App\Http\Controllers\Airport;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Airport\AirportCreateRequest;
use App\Http\Requests\Airport\AirportUpdateRequest;
use App\Http\Resources\Airport\AirportResource;
use App\Http\Responses\ApiResponse;
use App\Models\Airport;
use App\Services\Airport\AirportServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function __construct(private readonly AirportServiceInterface $airportService)
    {
    }

    /**
     * Get All Airports
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ApiResponse::success(
            message: 'Get All Airports',
            data: AirportResource::collection($this->airportService->getAll())
        );
    }

    /**
     * Create new airport
     * @param AirportCreateRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function store(AirportCreateRequest $request): JsonResponse
    {
        $airport = $this->airportService->create($request->validated());
        return ApiResponse::success(
            message: 'Airport created',
            status: 201,
            data: ['airport' => new AirportResource($airport)]
        );
    }

    /**
     * Update an airport
     * @param AirportUpdateRequest $request
     * @param Airport $airport
     * @return JsonResponse
     * @throws CustomException
     */
    public function update(AirportUpdateRequest $request, Airport $airport): JsonResponse
    {
        $updatedAirport = $this->airportService->update($airport, $request->validated());
        return ApiResponse::success(
            message: "Airport updated.",
            data: ['airport' => new AirportResource($updatedAirport)]
        );
    }
}
