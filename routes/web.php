<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\API\Tokens\TokenController;
use App\Models\Task;

Route::get(
    '/',
    function () {
        return Inertia::render('Welcome');
    }
)->name('home');

Route::get(
    'dashboard',
    function () {
        return Inertia::render('Dashboard', [
            'tasks' => Task::all()
        ]);
    }
)->middleware([
    'auth',
    'verified'
])->name('dashboard');

Route::middleware(
    'auth'
)->group(function () {
    Route::get(
        'api/tokens/create',
        [
            TokenController::class,
            'create'
        ]
    );

    Route::get(
        'api/tokens/renew',
        [
            TokenController::class,
            'renew'
        ]
    );

    Route::get(
        'api/tokens/delete',
        [
            TokenController::class,
            'delete'
        ]
    );
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
