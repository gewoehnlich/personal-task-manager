<?php

namespace App\Ship\Components;

use App\Ship\Parents\Actions\Subaction;

class CallSubactionComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Subaction;
    }
}
