<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
])->group(
    function () {
        Route::resources([
            'tasks' => TaskController::class,
        ]);
    }
);
