<?php

namespace App\Containers\Bills\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class BillServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            paths: [ __DIR__ . '/../Migrations' ],
        );

        Route::prefix('api')
            ->name('api.')
            ->middleware('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
