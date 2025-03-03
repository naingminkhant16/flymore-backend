<?php

namespace App\Repositories\Airline;

use App\Exceptions\InternalServerErrorException;
use App\Models\Airline;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

readonly class AirlineRepository implements AirlineRepositoryInterface
{
    public function __construct(private readonly Airline $airline)
    {
    }

    /**
     * @param array $data
     * @return Airline
     * @throws InternalServerErrorException
     */
    public function create(array $data): Airline
    {
        try {
            return $this->airline->create([
                'name' => $data['name'],
                'code' => $data['code'],
                'country' => $data['country'],
            ]);
        } catch (\Exception $e) {
            Log::error("AirlineRepository::create(): Failed to create airline: {$e->getMessage()}");
            throw new InternalServerErrorException("Failed to create airline");
        }
    }
}
