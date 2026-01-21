<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Components\CallSubactionComponent;

trait CanCallSubactionTrait
{
    public function subaction(
        string $class,
        Dto $dto,
    ): mixed {
        return CallSubactionComponent::call(
            class: $class,
            dto: $dto,
        );
    }
}
