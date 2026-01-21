<?php

namespace App\Containers\Users\Providers;

use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
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
    }
}
