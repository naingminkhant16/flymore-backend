<?php

namespace App\Http\Requests\Booking;

use App\Http\Responses\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookingCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flight_id' => 'required|exists:flights,id',
            'booked_by' => 'required|string|max:100',
            'booked_email' => 'required|string|email',
            'booked_phone' => 'required|string|max:20',
            'passengers' => 'required|array|min:1',
            'passengers.*.first_name' => 'required|string|max:100',
            'passengers.*.last_name' => 'required|string|max:100',
            'passengers.*.passport_number' => 'required|string|max:20',
            'passengers.*.email' => 'required|email',
            'passengers.*.phone' => 'required|max:20',
            'passengers.*.gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'passengers.*.nationality' => 'required|string|max:100',
            'passengers.*.age' => 'required|integer|min:1|max:120',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'flight_id.required' => 'The flight ID is required.',
            'flight_id.exists' => 'The selected flight does not exist.',

            'booked_by.required' => 'Please provide the name of the person booking the flight.',
            'booked_email.required' => 'The email of the person booking is required.',
            'booked_email.email' => 'Please provide a valid email address.',
            'booked_phone.required' => 'The phone number of the booker is required.',

            'passengers.required' => 'At least one passenger is required.',
            'passengers.array' => 'Passengers must be an array.',
            'passengers.min' => 'You must include at least one passenger.',
            'passengers.*.first_name.required' => 'Each passenger must have a first name.',
            'passengers.*.last_name.required' => 'Each passenger must have a last name.',
            'passengers.*.passport_number.required' => 'Each passenger must provide a passport number.',
            'passengers.*.email.required' => 'Each passenger must have an email.',
            'passengers.*.email.email' => 'Please provide a valid email for each passenger.',
            'passengers.*.phone.required' => 'Each passenger must have a phone number.',
            'passengers.*.gender.required' => 'Please select a gender for each passenger.',
            'passengers.*.gender.in' => 'Gender must be either male, female, or other.',
            'passengers.*.nationality.required' => 'Each passenger must have a nationality.',
            'passengers.*.age.required' => 'Each passenger must have an age.',
            'passengers.*.age.integer' => 'Age must be a valid number.',
            'passengers.*.age.min' => 'Age must be at least 1 year old.',
            'passengers.*.age.max' => 'Age must not be greater than 120 years old.',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            ApiResponse::error(
                "Validation failed!",
                422,
                ['errors' => $validator->errors()]
            )
        );
    }
}
