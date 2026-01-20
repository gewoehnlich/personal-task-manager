<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Components\CallActionComponent;

trait CanCallActionTrait
{
    public function action(
        string $class,
        Dto $dto,
    ): mixed {
        return CallActionComponent::call(
            class: $class,
            dto: $dto,
        );
    }
}
