<?php

namespace App\Containers\Projects\Routes;

use App\Containers\Projects\Controllers\Web\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'web',
    'auth',
)->group(function () {
    Route::get(
        uri: 'projects',
        action: [
            ProjectController::class,
            'index',
        ],
    );

    Route::post(
        uri: 'projects',
        action: [
            ProjectController::class,
            'create',
        ],
    );

    Route::put(
        uri: 'projects/{id}',
        action: [
            ProjectController::class,
            'update',
        ],
    );

    Route::delete(
        uri: 'projects/{id}',
        action: [
            ProjectController::class,
            'delete',
        ],
    );
});
