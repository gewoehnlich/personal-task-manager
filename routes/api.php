<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get(
    'tasks',
    [TaskController::class, 'index']
)->name('tasks.index');

Route::post(
    'tasks/create',
    [TaskController::class, 'store']
)->name('tasks.store');

Route::put(
    'tasks/edit/{id}',
    [TaskController::class, 'update']
)->name('tasks.update');

Route::delete(
    'tasks/delete/{id}',
    [TaskController::class, 'delete']
)->name('tasks.delete');
