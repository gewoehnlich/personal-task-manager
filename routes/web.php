<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return 'test';
});

Route::get('/kanban', function () {
    return view('kanban');
});


Route::get(
    '/api/tasks',
    [TaskController::class, 'index']
)->name('tasks.index');

Route::post(
    '/api/tasks/create',
    [TaskController::class, 'store']
)->name('tasks.store');

Route::put(
    '/api/tasks/update/{id}',
    [TaskController::class, 'update']
)->name('tasks.update');

Route::delete(
    '/api/tasks/delete/{id}',
    [TaskController::class, 'delete']
)->name('tasks.delete');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
