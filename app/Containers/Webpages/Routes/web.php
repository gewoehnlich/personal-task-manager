<?php

use App\Containers\Webpages\Controllers\DashboardWebpageController;
use App\Containers\Webpages\Controllers\WelcomeWebpageController;

Route::get(
    uri: '/',
    action: [
        WelcomeWebpageController::class,
        'show',
    ],
)
    ->name('home');

Route::get(
    uri: 'dashboard',
    action: [
        DashboardWebpageController::class,
        'show',
    ],
)
    ->middleware([
        'auth',
        'verified',
    ])
    ->name('dashboard');
