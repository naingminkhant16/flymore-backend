<?php

namespace App\Http\Controllers\Airport;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Airport\AirportCreateRequest;
use App\Http\Resources\Airport\AirportResource;
use App\Http\Responses\ApiResponse;
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
     * @throws InternalServerErrorException
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
}
