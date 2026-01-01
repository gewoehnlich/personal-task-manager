<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Transporters\Transporter;
use App\Ship\Components\CallTaskComponent;

trait CanCallTaskTrait
{
    public function task(
        string $className,
        Transporter $transporter,
    ): mixed {
        return CallTaskComponent::call(
            className: $className,
            transporter: $transporter,
        );
    }
}
