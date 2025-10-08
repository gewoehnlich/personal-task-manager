<?php

namespace App\Containers\Bills\Routes;

use App\Containers\Bills\Controllers\Api\BillController;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
)
    ->group(function () {
        Route::get(
            uri: 'tasks/{task}/bills',
            action: [
                BillController::class,
                'get',
            ],
        );

        Route::post(
            uri: 'tasks/{task}/bills',
            action: [
                BillController::class,
                'create',
            ],
        );

        Route::put(
            uri: 'tasks/{task}/bills/{id}',
            action: [
                BillController::class,
                'update',
            ],
        );

        Route::delete(
            uri: 'tasks/{task}/bills/{id}',
            action: [
                BillController::class,
                'delete',
            ],
        );
    });
