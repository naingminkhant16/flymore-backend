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

    public static function success(string $message, int $status = 200, array|object $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta_data' => self::getMetaData(),
            'data' => $data
        ], $status);
    }

    public static function error(string $message, int $status = 500, array|object $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta_data' => self::getMetaData(),
            'data' => $data
        ], $status);
    }

    public static function response(string $message, int $status = 200, array|object $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'meta_data' => self::getMetaData(),
            'data' => $data
        ], $status);
    }
}
