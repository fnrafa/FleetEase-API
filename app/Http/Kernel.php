<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckJsonRequest;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;

class Kernel extends HttpKernel
{
    protected $middleware = [
        HandleCors::class,
        ValidatePostSize::class,
        ConvertEmptyStringsToNull::class,
    ];


    protected $middlewareGroups = [
        'api' => [
            ThrottleRequests::class . ':api',
            SubstituteBindings::class,
            CheckJsonRequest::class,
        ],
    ];

    protected $middlewareAliases = [
        'auth' => Authenticate::class,
        'role' => RoleMiddleware::class,
    ];
}
