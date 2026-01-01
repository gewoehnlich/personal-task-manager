<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Transporters\Transporter;
use App\Ship\Components\CallCommandComponent;

trait CanCallCommandTrait
{
    public function command(
        string $className,
        Transporter $transporter,
    ): mixed {
        return CallCommandComponent::call(
            className: $className,
            transporter: $transporter,
        );
    }
}
