<?php

namespace App\Containers\Tasks\Routes;

use App\Containers\Tasks\Controllers\Api\TaskController;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
])
    ->name('tasks.')
    ->group(function () {
        Route::get(
            uri: 'tasks',
            action: [
                TaskController::class,
                'index',
            ],
        )->name('index');

        Route::post(
            uri: 'tasks',
            action: [
                TaskController::class,
                'create',
            ],
        )->name('create');

        Route::put(
            uri: 'tasks/{uuid}',
            action: [
                TaskController::class,
                'update',
            ],
        )->name('update');

        Route::delete(
            uri: 'tasks/{uuid}',
            action: [
                TaskController::class,
                'delete',
            ],
        )->name('delete');

        Route::post(
            uri: 'tasks/{uuid}/restore',
            action: [
                TaskController::class,
                'restore',
            ],
        )->name('restore');
    });
