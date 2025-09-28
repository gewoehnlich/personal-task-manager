<?php

namespace App\Ship\Components;

use App\Ship\Parents\Commands\Command;

class CallAction extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Command;
    }
}
