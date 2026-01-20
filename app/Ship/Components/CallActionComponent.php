<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Actions\Action;

final readonly class CallActionComponent extends CallComponent
{
    protected static function isInstanceOfComponentClass(
        object $instance,
    ): bool {
        return $instance instanceof Action;
    }

    protected static function componentClass(): string
    {
        return Action::class;
    }
}
