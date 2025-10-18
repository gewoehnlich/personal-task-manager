<?php

use App\Containers\Auth\Controllers\AuthenticatedSessionController;
use App\Containers\Auth\Controllers\ConfirmablePasswordController;
use App\Containers\Auth\Controllers\EmailVerificationNotificationController;
use App\Containers\Auth\Controllers\EmailVerificationPromptController;
use App\Containers\Auth\Controllers\NewPasswordController;
use App\Containers\Auth\Controllers\PasswordResetLinkController;
use App\Containers\Auth\Controllers\RegisteredUserController;
use App\Containers\Auth\Controllers\TokenController;
use App\Containers\Auth\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->prefix('/tokens')
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

Route::middleware(
    'web',
    'guest',
)->group(function () {
    Route::get('register', [
        RegisteredUserController::class,
        'create',
    ])->name('register');

    Route::post('register', [
        RegisteredUserController::class,
        'store',
    ]);

    Route::get('login', [
        AuthenticatedSessionController::class,
        'create',
    ])->name('login');

    Route::post('login', [
        AuthenticatedSessionController::class,
        'store',
    ]);

    Route::get('forgot-password', [
        PasswordResetLinkController::class,
        'create',
    ])->name('password.request');

    Route::post('forgot-password', [
        PasswordResetLinkController::class,
        'store',
    ])->name('password.email');

    Route::get('reset-password/{token}', [
        NewPasswordController::class,
        'create',
    ])->name('password.reset');

    Route::post('reset-password', [
        NewPasswordController::class,
        'store',
    ])->name('password.store');
});

Route::middleware(
    'web',
    'auth',
)->group(function () {
    Route::get(
        'verify-email',
        EmailVerificationPromptController::class
    )->name('verification.notice');

    Route::get(
        'verify-email/{id}/{hash}',
        VerifyEmailController::class
    )->middleware([
        'signed',
        'throttle:6,1',
    ])->name('verification.verify');

    Route::post('email/verification-notification', [
        EmailVerificationNotificationController::class,
        'store',
    ])
        ->middleware('throttle:6,1')
        ->name('verification.send');

//    Route::get('confirm-password', [
//        ConfirmablePasswordController::class,
//        'show',
//    ])->name('password.confirm');

    Route::post('confirm-password', [
        ConfirmablePasswordController::class,
        'store',
    ])->name('password.confirm');

    Route::post('logout', [
        AuthenticatedSessionController::class,
        'destroy',
    ])->name('logout');
});
