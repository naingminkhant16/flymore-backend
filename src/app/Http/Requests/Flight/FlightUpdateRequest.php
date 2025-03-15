<?php

namespace App\Http\Requests\Flight;

use App\Enums\FlightStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class FlightUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flight_number' => 'required|string',
            'airline_id' => 'required|exists:airlines,id',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date_format:H:i:s',
            'arrival_time' => 'required|date_format:H:i:s',
            'flight_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'price' => 'required|numeric',
            'status' => ['required', new Enum(FlightStatus::class)],
            'allowed_kg' => 'required|numeric',
            'available_seats' => 'required|numeric',
        ];
    }

    /**
     * Custom validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'flight_number.required' => 'The flight number is required.',
            'flight_number.string' => 'The flight number must be a valid string.',

            'airline_id.required' => 'Please select an airline.',
            'airline_id.exists' => 'The selected airline does not exist.',

            'departure_airport_id.required' => 'Please select a departure airport.',
            'departure_airport_id.exists' => 'The selected departure airport does not exist.',

            'arrival_airport_id.required' => 'Please select an arrival airport.',
            'arrival_airport_id.exists' => 'The selected arrival airport does not exist.',

            'departure_time.required' => 'The departure time is required.',
            'departure_time.date_format' => 'The departure time must be in HH:MM:SS format (24-hour).',

            'arrival_time.required' => 'The arrival time is required.',
            'arrival_time.date_format' => 'The arrival time must be in HH:MM:SS format (24-hour).',

            'flight_date.required' => 'The flight date is required.',
            'flight_date.date_format' => 'The flight date must be in YYYY-MM-DD format.',
            'flight_date.after_or_equal' => 'The flight date must be today or a future date.',

            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a numeric value.',

            'status.required' => 'The status is required.',

            'allowed_kg.required' => 'The allowed baggage weight is required.',
            'allowed_kg.numeric' => 'The allowed baggage weight must be a numeric value.',

            'available_seats.required' => 'The number of available seats is required.',
            'available_seats.numeric' => 'The available seats must be a numeric value.',
        ];
    }
}
