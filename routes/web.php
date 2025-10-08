<?php

use App\Containers\Tasks\Models\Task;
use App\Ship\Exceptions\ContainersDirectoryIsEmptyException;
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
            throw new ContainersDirectoryIsEmptyException();
        }

        foreach ($containersDirectories as $dir) {
            $routePath = $dir . '/Routes/web.php';

            if (file_exists(filename: $routePath)) {
                Route::group(
                    attributes: [],
                    routes: $routePath,
                );
            }
        }
    });
