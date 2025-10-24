<?php

namespace App\Containers\Webpages\Actions;

use App\Ship\Parents\Actions\Action;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final readonly class DashboardWebpageAction extends Action
{
    public function run(
        array $data,
    ): InertiaResponse {
        return Inertia::render(
            component: 'Dashboard',
            props: $data,
        );
    }
}
