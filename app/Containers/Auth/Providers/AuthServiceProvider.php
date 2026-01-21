<?php

namespace App\Containers\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            paths: [__DIR__ . '/../Migrations'],
        );

        Route::middleware('web')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
