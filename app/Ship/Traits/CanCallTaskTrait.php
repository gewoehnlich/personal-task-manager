<?php

namespace App\Ship\Traits;

trait CanCallTaskTrait
{
    public function task(...$parameters)
    {
        return resolve(\App\Ship\Components\CallTaskComponent::class)
            ->call(...$parameters);
    }
}
