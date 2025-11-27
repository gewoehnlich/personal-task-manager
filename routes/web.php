<?php

use App\Containers\Tasks\Models\Task;
use App\Ship\Actions\RoutesContainersRegisterAction;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('web')
    ->group(function () {
        Route::get('/', function () {
            return Inertia::render('Welcome');
        })->name('home');

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard', [
                'tasks' => Task::with('bills')->get()
            ]);
        })
            ->middleware([
                'auth',
                'verified',
            ])
            ->name('dashboard');

        (new RoutesContainersRegisterAction())->run(
            channel: 'web',
        );
    });
