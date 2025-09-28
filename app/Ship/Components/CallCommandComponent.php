<?php

namespace App\Ship\Components;

use App\Ship\Parents\Commands\Command;

class CallCommandComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Command;
    }
}
