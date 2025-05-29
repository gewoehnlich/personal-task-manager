<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Tasks\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// add auth
Route::post(
    'tasks/create',
    [
        TaskController::class,
        'create'
    ]
)->name(
    'tasks.create'
);

Route::get(
    'tasks',
    [
        TaskController::class,
        'read'
    ]
)->name(
    'tasks.read'
);

Route::put(
    'tasks/edit/{id}',
    [
        TaskController::class,
        'update'
    ]
)->name(
    'tasks.update'
);

Route::delete(
    'tasks/delete/{id}',
    [
        TaskController::class,
        'delete'
    ]
)->name(
    'tasks.delete'
);
