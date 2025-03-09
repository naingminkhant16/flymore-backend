<?php

namespace App\Http\Middleware;

use App\Enums\RoleName;
use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSystemAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole(RoleName::SYSTEM_ADMIN)) {
            return $next($request);
        };
        return ApiResponse::error('Unauthorized', 401);
    }
}
