<?php

namespace App\Ship\Traits;

trait CanCallActionTrait
{
    public function action(...$parameters)
    {
        return resolve(\App\Ship\Components\CallActionComponent::class)
            ->call(...$parameters);
    }
}
