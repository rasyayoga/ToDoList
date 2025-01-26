<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLogin;
use App\Http\Middleware\IsUser;
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
            'IsAdmin' => IsAdmin::class,
            'IsUser' => IsUser::class,
            'IsLogin' => IsLogin::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
