<?php

use App\Ship\Actions\RoutesContainersRegisterAction;
use App\Ship\Middleware\EnsureAcceptHeaderIsJson;
use Illuminate\Support\Facades\Route;

Route::middleware(
    'auth:sanctum',
    EnsureAcceptHeaderIsJson::class,
)
    ->group(function () {
        (new RoutesContainersRegisterAction())->run(
            channel: 'api',
        );
    });
