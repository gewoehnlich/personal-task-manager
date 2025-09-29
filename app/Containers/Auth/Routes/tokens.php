<?php

use App\Containers\Auth\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('')
    ->group(function () {
        Route::resources([
            'tokens' => TokenController::class,
        ]);
    })->name('tokens.');

Route::get('test_token', [
    TokenController::class,
    'store',
]);
