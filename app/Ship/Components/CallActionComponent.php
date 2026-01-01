<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Actions\Action;

final class CallActionComponent extends CallComponent
{
    protected function parentInstance($instance): bool
    {
        return $instance instanceof Action;
    }
}
