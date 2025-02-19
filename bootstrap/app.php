<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

use App\Interface\ICustomException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ICustomException $exception) {
            return response(['message' => $exception->getMessage()], $exception->getCode());
        });

        $exceptions->render(function (ValidationException $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        });

        $exceptions->render(function (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
