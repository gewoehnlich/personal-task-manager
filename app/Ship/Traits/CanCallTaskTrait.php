<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Components\CallTaskComponent;

trait CanCallTaskTrait
{
    public function task(
        string $class,
        Dto $dto,
    ): mixed {
        return CallTaskComponent::call(
            class: $class,
            dto: $dto,
        );
    }
}
