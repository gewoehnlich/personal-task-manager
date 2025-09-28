<?php

namespace App\Ship\Components;

use App\Ship\Parents\Actions\Action;

class CallAction extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Action;
    }
}
