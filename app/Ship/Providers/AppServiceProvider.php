<?php

namespace App\Ship\Providers;

use App\Ship\Actions\MigrationsContainersGetAction;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $containersMigrations = (
            new MigrationsContainersGetAction()
        )->run();

        $this->loadMigrationsFrom(
            $containersMigrations
        );
    }
}
