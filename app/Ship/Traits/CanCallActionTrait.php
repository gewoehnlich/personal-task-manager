<?php

namespace App\Ship\Traits;

use App\Ship\Abstracts\Transporters\Transporter;
use App\Ship\Components\CallActionComponent;

trait CanCallActionTrait
{
    public function action(
        string $className,
        Transporter $transporter,
    ): mixed {
        return CallActionComponent::call(
            className: $className,
            transporter: $transporter,
        );
    }
}
