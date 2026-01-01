<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Commands\Command;

final readonly class CallCommandComponent extends CallComponent
{
    protected static function isInstanceOfComponentClass(
        object $instance,
    ): bool {
        return $instance instanceof Command;
    }

    protected static function componentClassName(): string
    {
        return Command::class;
    }
}
