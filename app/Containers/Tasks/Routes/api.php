<?php

use App\Containers\Tasks\Http\Controllers\TaskController;
use App\Http\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
])
    ->prefix('api/')
    ->group(
        function () {
            Route::post('tasks', [TaskController::class, 'store']);
            Route::get('tasks', [TaskController::class, 'index']);
            Route::put('tasks/{task}', [TaskController::class, 'update']);
            Route::delete('tasks/{task}', [TaskController::class, 'delete']);
        }
    );
