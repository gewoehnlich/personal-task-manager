<?php

namespace App\Ship\Traits;

trait CanCallSubactionTrait
{
    public function subaction(...$parameters)
    {
        return resolve(\App\Ship\Components\CallSubactionComponent::class)
            ->call(...$parameters);
    }
}
