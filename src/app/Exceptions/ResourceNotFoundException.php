<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class ResourceNotFoundException extends Exception
{
    public function __construct(string $resource_name, int $id)
    {
        parent::__construct("$resource_name not found with id : $id", 404);
    }

    public function render(): JsonResponse
    {
        return ApiResponse::error($this->getMessage(), 404);
    }
}
