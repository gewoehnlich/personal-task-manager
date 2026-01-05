<?php

namespace App\Containers\Projects\Routes;

use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->name('v1.')
    ->group(__DIR__ . '/api_v1.php');
