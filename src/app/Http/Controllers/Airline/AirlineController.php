<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Airline\AirlineCreateRequset;
use App\Http\Requests\Airline\AirlineUpdateRequest;
use App\Http\Resources\Airline\AirlineResource;
use App\Http\Responses\ApiResponse;
use App\Models\Airline;
use App\Services\Airline\AirlineServiceInterface;
use Illuminate\Http\JsonResponse;

class AirlineController extends Controller
{
    public function __construct(private readonly AirlineServiceInterface $airlineService) {}

    /**
     * Get All Airlines
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ApiResponse::success(
            'Get all Airlines',
            ['airlines' => AirlineResource::collection($this->airlineService->getAll())]
        );
    }

    /**
     * @param AirlineCreateRequset $request
     * @return JsonResponse
     */
    public function store(AirlineCreateRequset $request): JsonResponse
    {
        $airline = $this->airlineService->create($request->validated());
        return ApiResponse::success('Airline created', ['airline' => $airline]);
    }

    /**
     * @param AirlineUpdateRequest $request
     * @param Airline $airline
     * @return JsonResponse
     */
    public function update(AirlineUpdateRequest $request, Airline $airline): JsonResponse
    {
        $updatedAirline = $this->airlineService->update($airline, $request->validated());
        return ApiResponse::success('Airline updated', ['airline' => $updatedAirline]);
    }
}
