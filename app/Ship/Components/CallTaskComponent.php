<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Tasks\Task;

final readonly class CallTaskComponent extends CallComponent
{
    protected static function isInstanceOfComponentClass(
        object $instance,
    ): bool {
        return $instance instanceof Task;
    }

    protected static function componentClassName(): string
    {
        return Task::class;
    }
}
