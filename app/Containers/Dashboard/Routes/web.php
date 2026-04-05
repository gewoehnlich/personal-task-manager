<?php

use App\Containers\Dashboard\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->group(function () {
        Route::get(
            uri: '/dashboard',
            action: [
                DashboardController::class,
                'index'
            ],
        )
            ->middleware([
                'auth',
                'verified',
            ])
            ->name('dashboard');
    });
