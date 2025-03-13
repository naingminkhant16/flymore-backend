<?php

namespace App\Http\Resources\Flight;

use App\Http\Resources\Airline\AirlineResource;
use App\Http\Resources\Airport\AirportResource;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            'flight_number' => $this->flight_number,
            'airline' => new AirlineResource(Airline::find($this->airline_id)),
            'departure_airport' => new AirportResource(Airport::find($this->departure_airport_id)),
            'arrival_airport' => new AirportResource(Airport::find($this->arrival_airport_id)),
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'flight_date' => $this->flight_date,
            'price' => $this->price,
            'allowed_kg' => $this->allowed_kg,
            'status' => $this->status,
            'available_seats' => $this->available_seats
        ];
    }
}
