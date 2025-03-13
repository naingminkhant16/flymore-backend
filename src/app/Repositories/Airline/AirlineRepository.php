<?php

namespace App\Repositories\Airline;

use App\Exceptions\CustomException;
use App\Models\Airline;
use Illuminate\Support\Facades\Log;

readonly class AirlineRepository implements AirlineRepositoryInterface
{
    public function __construct(private readonly Airline $airline)
    {
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->airline->orderBy('name', 'asc')->get();
    }

    /**
     * @param array $data
     * @return Airline
     * @throws CustomException
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
            throw new CustomException("Failed to create airline");
        }
    }

    /**
     * @param Airline $airline
     * @param array $data
     * @return Airline
     * @throws CustomException
     */
    public function update(Airline $airline, array $data): Airline
    {
        try {
            $airline->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'country' => $data['country']
            ]);
            return $airline;
        } catch (\Exception $e) {
            Log::error("AirlineRepository::update(): Failed to update airline: {$e->getMessage()}");
            throw new CustomException("Failed to update airline");
        }
    }
}
