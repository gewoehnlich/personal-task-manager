<?php

namespace App\Containers\Webpages\Controllers;

use App\Containers\Tasks\Views\TaskIndexViewModel;
use App\Containers\Webpages\Actions\DashboardWebpageAction;
use App\Ship\Parents\Controllers\WebController;
use Inertia\Response as InertiaResponse;

final readonly class DashboardWebpageController extends WebController
{
    public function show(
        TaskIndexViewModel $view
    ): InertiaResponse {
        return $this->action(
            DashboardWebpageAction::class,
            ['tasks' => $view->toArray()],
        );
    }
}
