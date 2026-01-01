<?php

namespace App\Ship\Components;

use App\Ship\Abstracts\Actions\Subaction;

final readonly class CallSubactionComponent extends CallComponent
{
    protected static function isInstanceOfComponentClass(
        object $instance,
    ): bool {
        return $instance instanceof Subaction;
    }

    protected static function componentClassName(): string
    {
        return Subaction::class;
    }
}
