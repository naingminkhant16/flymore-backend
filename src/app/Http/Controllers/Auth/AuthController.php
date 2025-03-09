<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private readonly AuthServiceInterface $authService) {}

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->input('email'), $request->input('password'));
        return ApiResponse::success('Login success', data: $data);
    }
}
