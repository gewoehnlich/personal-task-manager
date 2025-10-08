<?php

use App\Containers\Tasks\Models\Task;
use App\Ship\Exceptions\ContainersDirectoryNotFoundException;
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

Route::middleware('web')
    ->group(function () {
        $containersDirectories = glob(
            pattern: base_path('/app/Containers/') . '*',
            flags: GLOB_ONLYDIR
        );

        if ($containersDirectories === false) {
            throw new ContainersDirectoryNotFoundException();
        }

        if ($containersDirectories === []) {
            throw new ContainersDirectoryNotFoundException();
        }

        dd($containersDirectories);
        // Route::middleware(
        //     'web',
        //     'auth',
        // )->group(
        //     base_path('/app/Containers/Settings/Routes/settings.php')
        // );
        // Route::middleware(
        //     'web',
        //     'guest',
        // )->group(
        //     base_path('/app/Containers/Auth/Routes/guest.php')
        // );
        // Route::middleware(
        //     'web',
        //     'auth',
        // )->group(
        //     base_path('/app/Containers/Auth/Routes/auth.php')
        // );
        //
        // Route::middleware(
        //     'web',
        // )->group(
        //     base_path('/app/Containers/Auth/Routes/tokens.php')
        // );
    });
