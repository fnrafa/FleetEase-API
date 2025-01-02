<?php

namespace App\Http\Middleware;

use App\Helpers\AuthHelper;
use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): JsonResponse
    {
        $user = AuthHelper::getAuthenticatedUser();

        if (!in_array($user->role, $roles)) {
            return ResponseHelper::Forbidden();
        }

        return $next($request);
    }
}
