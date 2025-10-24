<?php

use App\Ship\Actions\RoutesContainersRegisterAction;
use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->group(function () {
        (new RoutesContainersRegisterAction())->run(
            channel: 'web',
        );
    });
