<?php

namespace App\Http\Requests\Airline;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Responses\ApiResponse;
use Illuminate\Validation\ValidationException;

class AirlineCreateRequset extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:airlines,name',
            'code' => 'required|string|max:255|unique:airlines,code',
            'country' => 'required|string|max:255',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            ApiResponse::error(
                "Validation Failed!",
                422,
                ['errors' => $validator->errors()]
            )
        );
    }
}
