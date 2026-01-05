<?php

namespace App\Containers\Projects\Routes;

use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
)
    ->group(function () {
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
            uri: 'projects/{uuid}',
            action: [
                ProjectController::class,
                'update',
            ],
        );

        Route::delete(
            uri: 'projects/{uuid}',
            action: [
                ProjectController::class,
                'delete',
            ],
        );
    });
