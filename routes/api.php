<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;
use App\Http\Middleware\EnsureAcceptHeaderIsJson;

Route::middleware([
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class
])->group(
    function () {
        Route::resources([
            'tasks' => TaskController::class
        ]);
    }
);
