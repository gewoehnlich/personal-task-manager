<?php

use App\Containers\Auth\Controllers\AuthenticatedSessionController;
use App\Containers\Auth\Controllers\NewPasswordController;
use App\Containers\Auth\Controllers\PasswordResetLinkController;
use App\Containers\Auth\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

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
