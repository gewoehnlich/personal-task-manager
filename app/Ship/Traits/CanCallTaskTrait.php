<?php

namespace App\Ship\Traits;

use App\Ship\Components\CallTaskComponent;

trait CanCallTaskTrait
{
    public function task(...$parameters)
    {
        return resolve(CallTaskComponent::class)
            ->call(...$parameters);
    }
}
