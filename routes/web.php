<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('web')
    ->group(function () {
        Route::get('/', function () {
            return Inertia::render('Welcome');
        })->name('home');
    });
