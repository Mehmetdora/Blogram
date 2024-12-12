<?php

use App\Http\Middleware\CheckProfileCreated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check_profile' => App\Http\Middleware\CheckProfileCreated::class,
            'auth_admin' => App\Http\Middleware\IsAdmin::class,
            'auth_user' => App\Http\Middleware\AuthMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
