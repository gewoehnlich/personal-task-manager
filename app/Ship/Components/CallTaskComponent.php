<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Tasks\Task;

class CallTaskComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Task;
    }
}
