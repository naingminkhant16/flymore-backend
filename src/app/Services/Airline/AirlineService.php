<?php

namespace App\Services\Airline;


use App\Exceptions\InternalServerErrorException;
use App\Models\Airline;
use App\Repositories\Airline\AirlineRepository;


readonly class AirlineService implements AirlineServiceInterface
{
    public function __construct(private AirlineRepository $airlineRepository)
    {
    }

    /**
     * @param array $data
     * @return Airline
     * @throws InternalServerErrorException
     */
    public function create(array $data): Airline
    {
        return $this->airlineRepository->create($data);
    }
}
