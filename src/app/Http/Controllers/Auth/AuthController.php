<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LoginFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthServiceInterface $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->input('email'), $request->input('password'));
        return ApiResponse::success('Login success', $data);
    }

    public function me()
    {
        return APiResponse::success('success', ['user' => auth()->user()]);
    }
}
