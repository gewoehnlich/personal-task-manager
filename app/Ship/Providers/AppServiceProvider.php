<?php

namespace App\Ship\Providers;

use App\Ship\Actions\MigrationsContainersGetAction;
use Illuminate\Support\Facades\URL;
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
        )
            ->run()
            ->data;

        foreach ($containersMigrations as $folder) {
            $this->loadMigrationsFrom(
                $folder,
            );
        }

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
