<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class LoginFailException extends Exception
{
    public function __construct(string $message = "Invalid credentials!", private readonly int $status = 400)
    {
        parent::__construct($message, $this->status);
    }

    public function render(): JsonResponse
    {
        return ApiResponse::error($this->getMessage(), $this->status);
    }
}
