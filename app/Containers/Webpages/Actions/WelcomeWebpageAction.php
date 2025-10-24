<?php

namespace App\Containers\Webpages\Actions;

use App\Ship\Parents\Actions\Action;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final readonly class WelcomeWebpageAction extends Action
{
    public function run(): InertiaResponse
    {
        return Inertia::render('Welcome');
    }
}
