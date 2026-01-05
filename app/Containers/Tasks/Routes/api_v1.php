<?php

namespace App\Containers\Tasks\Routes;

use App\Containers\Tasks\Controllers\Api\TaskController;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
)->group(function () {
    Route::get(
        uri: 'tasks/{uuid}',
        action: [
            TaskController::class,
            'get',
        ],
    );

    Route::get(
        uri: 'tasks',
        action: [
            TaskController::class,
            'index',
        ],
    );

    Route::post(
        uri: 'tasks',
        action: [
            TaskController::class,
            'create',
        ],
    );

    Route::put(
        uri: 'tasks/{uuid}',
        action: [
            TaskController::class,
            'update',
        ],
    );

    Route::delete(
        uri: 'tasks/{uuid}',
        action: [
            TaskController::class,
            'delete',
        ],
    );
});
