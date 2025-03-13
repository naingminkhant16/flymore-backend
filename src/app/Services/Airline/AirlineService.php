<?php

namespace App\Services\Airline;


use App\Exceptions\CustomException;
use App\Models\Airline;
use App\Repositories\Airline\AirlineRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class AirlineService implements AirlineServiceInterface
{
    public function __construct(private AirlineRepository $airlineRepository)
    {
    }

    /**
     * Summary of getAll
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->airlineRepository->getAll();
    }

    /**
     * @param array $data
     * @return Airline
     * @throws CustomException
     */
    public function create(array $data): Airline
    {
        return $this->airlineRepository->create($data);
    }

    /**
     * @param Airline $airline
     * @param array $data
     * @return Airline
     * @throws CustomException
     */
    public function update(Airline $airline, array $data): Airline
    {
        return $this->airlineRepository->update($airline, $data);
    }
}
