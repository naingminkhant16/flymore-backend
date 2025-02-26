<?php

namespace App\Http\Responses;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class ApiResponse
{
    private static function getMetaData(): array
    {
        return [
            'method' => strtolower(Request::method()),
            'endpoint' => Request::url(),
            'duration' => microtime(true),
        ];
    }

    public static function success(string $message, array|object $data = null): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'meta_data' => self::getMetaData(),
            'data' => $data
        ]);
    }

    public static function error(string $message, int $status, array|object $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta_data' => self::getMetaData(),
            'data' => $data
        ]);
    }
}
