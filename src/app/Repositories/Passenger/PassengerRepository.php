<?php

namespace App\Repositories\Passenger;

use App\Models\Passenger;
use Illuminate\Support\Facades\Log;

class PassengerRepository implements PassengerRepositoryInterface
{
    public function __construct(private readonly Passenger $passenger) {}

    /**
     * Create new passenger
     * @param array $data
     * @return Passenger
     * @throws \App\Exceptions\CustomException
     */
    public function create(array $data): Passenger
    {
        try {
            return $this->passenger->create([
                'booking_id' => $data['booking_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'passport_number' => $data['passport_number'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'nationality' => $data['nationality'],
                'age' => $data['age']
            ]);
        } catch (\Exception $e) {
            Log::error("PassengerRepository::create(): Failed to create passenger: {$e->getMessage()}");
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
}
