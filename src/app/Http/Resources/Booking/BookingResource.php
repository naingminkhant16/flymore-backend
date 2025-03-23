<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Flight\FlightResource;
use App\Http\Resources\Passenger\PassengerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'flight' => new FlightResource($this->flight),
            'status' => $this->status,
            'booked_at' => $this->booked_at,
            'booked_by' => $this->booked_by,
            'booked_email' => $this->booked_email,
            'booked_phone' => $this->booked_phone,
            'passengers' => PassengerResource::collection($this->passengers)
        ];
    }
}
