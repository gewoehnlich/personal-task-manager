<?php

namespace App\Containers\Tasks\Routes;

use App\Containers\Tasks\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: 'tasks/{id}',
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
    uri: 'tasks/{id}',
    action: [
        TaskController::class,
        'update',
    ],
);

Route::delete(
    uri: 'tasks/{id}',
    action: [
        TaskController::class,
        'delete',
    ],
);
