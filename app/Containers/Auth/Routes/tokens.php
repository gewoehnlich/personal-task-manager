<?php

use App\Containers\Auth\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tokens')
    ->group(function () {
        Route::get('/create', [
            TokenController::class,
            'create',
        ]);
        Route::get('/refresh', [
            TokenController::class,
            'refresh',
        ]);
        Route::get('/revoke', [
            TokenController::class,
            'revoke',
        ]);
    });
