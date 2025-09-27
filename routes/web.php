<?php

use App\Containers\Tasks\Models\Task;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'tasks' => Task::all(),
    ]);
})->middleware([
    'auth',
    'verified',
])->name('dashboard');
