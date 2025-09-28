<?php

namespace App\Ship\Components;

use App\Ship\Parents\Actions\Action;

class CallActionComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Action;
    }
}
