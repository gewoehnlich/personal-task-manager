<?php

use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use App\Ship\Middleware\HandleAppearance;
use App\Ship\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Support\Facades\Route;

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/commands.php',
        health: '/up',
        then: function () {
            // todo: moved the routes from over here
            Route::middleware(
                'web',
                'auth',
            )->group(
                base_path('/app/Containers/Settings/Routes/settings.php')
            );

            Route::middleware(
                'web',
                'guest',
            )->group(
                base_path('/app/Containers/Auth/Routes/guest.php')
            );

            Route::middleware(
                'web',
                'auth',
            )->group(
                base_path('/app/Containers/Auth/Routes/auth.php')
            );

            Route::middleware(
                'web',
            )->group(
                base_path('/app/Containers/Auth/Routes/tokens.php')
            );

            Route::middleware(
                'auth:sanctum',
                EnsureAcceptHeaderIsJson::class,
            )->prefix(
                '/api'
            )->group(
                base_path('/app/Containers/Tasks/Routes/api.php'),
            );
        },
    )->withMiddleware(
        function (Middleware $middleware) {
            $middleware->encryptCookies(
                except: ['appearance', 'sidebar_state']
            );

            $middleware->web(append: [
                HandleAppearance::class,
                HandleInertiaRequests::class,
                AddLinkHeadersForPreloadedAssets::class,
            ]);
        }
    )->withExceptions(
        function (Exceptions $exceptions) {
            //
        }
    )->create();
