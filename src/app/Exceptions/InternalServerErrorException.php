<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class InternalServerErrorException extends Exception
{
    public function __construct(string $message = "Internal Server Error", private readonly int $status = 500)
    {
        parent::__construct($message, $this->status);
    }

    public function render(): JsonResponse
    {
        return ApiResponse::error($this->getMessage(), $this->status);
    }
}
