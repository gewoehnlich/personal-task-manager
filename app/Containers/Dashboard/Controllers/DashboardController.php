<?php

namespace App\Containers\Dashboard\Controllers;

use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Controllers\WebController;
use Inertia\Inertia;
use Inertia\Response;

final readonly class DashboardController extends WebController
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'tasks' => Task::query()
                ->with('project')
                ->with('bills')
                ->get(),
        ]);
    }
}
