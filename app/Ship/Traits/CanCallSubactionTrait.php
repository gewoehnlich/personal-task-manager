<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Transporters\Transporter;
use App\Ship\Components\CallSubactionComponent;

trait CanCallSubactionTrait
{
    public function subaction(
        string $className,
        Transporter $transporter,
    ): mixed {
        return CallSubactionComponent::call(
            className: $className,
            transporter: $transporter,
        );
    }
}
