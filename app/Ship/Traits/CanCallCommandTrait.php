<?php

namespace App\Ship\Traits;

use App\Ship\Components\CallCommandComponent;

trait CanCallCommandTrait
{
    public function command(...$parameters)
    {
        return resolve(CallCommandComponent::class)
            ->call(...$parameters);
    }
}
