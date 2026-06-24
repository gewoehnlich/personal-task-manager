<?php

namespace App\Ship\Abstracts\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

abstract class ServiceProvider extends BaseServiceProvider
{
    protected const string DIRECTORY = __DIR__;

    public function boot(): void
    {
        $this->registerMigrations(
            paths: $this->migrationDirectories(),
        );

        $this->registerApiRoutes(
            file: $this->apiRoutesFile(),
        );

        $this->registerWebRoutes(
            file: $this->webRoutesFile(),
        );
    }

    protected function registerMigrations(
        array $paths,
    ): void {
        $this->loadMigrationsFrom(
            paths: $paths,
        );
    }

    protected function registerApiRoutes(
        string $file,
    ): void {
        if (! file_exists($file)) {
            return;
        }

        Route::prefix('api')
            ->name('api.')
            ->middleware('api')
            ->group($file);
    }

    protected function registerWebRoutes(
        string $file,
    ): void {
        if (! file_exists($file)) {
            return;
        }

        Route::middleware('web')
            ->group($file);
    }

    protected static function migrationDirectories(): array
    {
        return [
            static::DIRECTORY . '/../Migrations',
        ];
    }

    protected static function apiRoutesFile(): string
    {
        return static::DIRECTORY . '/../Routes/api.php';
    }

    protected static function webRoutesFile(): string
    {
        return static::DIRECTORY . '/../Routes/web.php';
    }
}
