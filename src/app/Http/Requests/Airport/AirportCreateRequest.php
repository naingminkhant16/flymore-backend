<?php

namespace App\Http\Requests\Airport;

use App\Http\Responses\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AirportCreateRequest extends FormRequest
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
            'name' => 'required|string|unique:airports,name|max:255',
            'code' => 'required|string|unique:airports,code|max:100',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100'
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
            ApiResponse::response(
                'Validation Failed!',
                422,
                ['errors' => $validator->errors()])
        );
    }
}
