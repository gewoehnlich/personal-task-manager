<?php

namespace App\Containers\Webpages\Controllers;

use App\Containers\Tasks\Models\Task;
use App\Containers\Webpages\Actions\DashboardWebpageAction;
use App\Ship\Parents\Controllers\WebController;
use Inertia\Response as InertiaResponse;

final readonly class DashboardWebpageController extends WebController
{
    public function show(): InertiaResponse
    {
        return $this->action(DashboardWebpageAction::class, [
            'tasks' => Task::with('bills')->get()
        ]);
    }
}
