<?php

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
        health: '/up',
        then: function () {
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
