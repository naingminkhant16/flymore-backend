<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Airline\AirlineCreateRequset;
use App\Http\Responses\ApiResponse;
use App\Services\Airline\AirlineServiceInterface;
use Illuminate\Http\JsonResponse;

class AirlineController extends Controller
{
    public function __construct(private readonly AirlineServiceInterface $airlineService)
    {
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
}
