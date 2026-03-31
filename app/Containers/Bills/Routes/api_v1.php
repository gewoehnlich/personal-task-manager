<?php

namespace App\Containers\Bills\Routes;

use App\Containers\Bills\Controllers\Api\BillController;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
)
    ->name('bills.')
    ->group(function () {
        Route::get(
            uri: 'tasks/{task}/bills',
            action: [
                BillController::class,
                'index',
            ],
        )->name('index');

        Route::post(
            uri: 'tasks/{task}/bills',
            action: [
                BillController::class,
                'create',
            ],
        )->name('create');

        Route::put(
            uri: 'tasks/{task}/bills/{uuid}',
            action: [
                BillController::class,
                'update',
            ],
        )->name('update');

        Route::delete(
            uri: 'tasks/{task}/bills/{uuid}',
            action: [
                BillController::class,
                'delete',
            ],
        )->name('delete');

        Route::post(
            uri: 'tasks/{task}/bills/{uuid}',
            action: [
                BillController::class,
                'restore',
            ],
        )->name('restore');
    });
