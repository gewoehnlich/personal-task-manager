<?php

namespace App\Containers\Webpages\Controllers;

use App\Containers\Webpages\Actions\WelcomeWebpageAction;
use App\Ship\Parents\Controllers\WebController;
use Inertia\Response as InertiaResponse;

final readonly class WelcomeWebpageController extends WebController
{
    public function show(): InertiaResponse
    {
        return $this->action(
            WelcomeWebpageAction::class,
        );
    }
}
