<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Components\CallCommandComponent;

trait CanCallCommandTrait
{
    public function command(
        string $class,
        Dto $dto,
    ): mixed {
        return CallCommandComponent::call(
            class: $class,
            dto: $dto,
        );
    }
}
