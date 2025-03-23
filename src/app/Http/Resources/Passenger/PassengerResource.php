<?php

namespace App\Http\Resources\Passenger;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'passport_number' => $this->passport_number,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'age' => $this->age
        ];
    }
}
