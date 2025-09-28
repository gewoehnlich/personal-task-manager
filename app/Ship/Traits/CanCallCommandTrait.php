<?php

namespace App\Ship\Traits;

trait CanCallCommandTrait
{
    public function command(...$parameters)
    {
        return resolve(\App\Ship\Components\CallCommandComponent::class)
            ->call(...$parameters);
    }
}
