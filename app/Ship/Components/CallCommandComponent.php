<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Commands\Command;

final class CallCommandComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Command;
    }
}
