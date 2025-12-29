<?php

namespace App\Ship\Traits;

use App\Ship\Components\CallSubactionComponent;

trait CanCallSubactionTrait
{
    public function subaction(...$parameters)
    {
        return resolve(CallSubactionComponent::class)
            ->call(...$parameters);
    }
}
