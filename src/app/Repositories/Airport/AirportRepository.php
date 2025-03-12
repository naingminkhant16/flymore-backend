<?php

namespace App\Repositories\Airport;

use App\Exceptions\InternalServerErrorException;
use App\Models\Airport;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

readonly class AirportRepository implements AirportRepositoryInterface
{
    public function __construct(private Airport $airport)
    {
    }

    /**
     * Get All Airports
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->airport->orderBy('name', 'asc')->get();
    }

    /**
     * @param array $data
     * @return Airport
     * @throws InternalServerErrorException
     */
    public function create(array $data): Airport
    {
        try {
            return $this->airport->create([
                'name' => $data['name'],
                'code' => $data['code'],
                'city' => $data['city'],
                'country' => $data['country']
            ]);
        } catch (Exception $e) {
            Log::error("AirlineRepository::create(): Failed to create airline: {$e->getMessage()}");
            throw new InternalServerErrorException("Failed to create airline!");
        }
    }

    /**
     * @param Airport $airport
     * @param array $data
     * @return Airport
     * @throws InternalServerErrorException
     */
    public function update(Airport $airport, array $data): Airport
    {
        try {
            $airport->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'city' => $data['city'],
                'country' => $data['country']
            ]);
            return $airport;
        } catch (Exception $e) {
            Log::error("AirlineRepository::update(): Failed to update airline: {$e->getMessage()}");
            throw new InternalServerErrorException("Failed to update airline!");
        }
    }
}
