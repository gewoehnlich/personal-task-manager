<?php

use App\Containers\Auth\Controllers\AuthenticatedSessionController;
use App\Containers\Auth\Controllers\ConfirmablePasswordController;
use App\Containers\Auth\Controllers\EmailVerificationNotificationController;
use App\Containers\Auth\Controllers\EmailVerificationPromptController;
use App\Containers\Auth\Controllers\TokenController;
use App\Containers\Auth\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

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

Route::get('confirm-password', [
    ConfirmablePasswordController::class,
    'show',
])->name('password.confirm');

Route::post('confirm-password', [
    ConfirmablePasswordController::class,
    'store',
])->name('password.confirm');

Route::post('logout', [
    AuthenticatedSessionController::class,
    'destroy',
])->name('logout');

Route::get('tokens/create', [
    TokenController::class,
    'create',
]);

Route::get('tokens/renew', [
    TokenController::class,
    'renew',
]);

Route::get('tokens/delete', [
    TokenController::class,
    'delete',
]);
