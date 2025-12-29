<?php

namespace App\Ship\Traits;

use App\Ship\Components\CallActionComponent;

trait CanCallActionTrait
{
    public function action(...$parameters)
    {
        return resolve(CallActionComponent::class)
            ->call(...$parameters);
    }
}
