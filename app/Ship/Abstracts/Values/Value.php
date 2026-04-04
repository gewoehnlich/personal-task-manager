<?php

namespace App\Ship\Abstracts\Values;

use App\Ship\Traits\Validatable;

abstract readonly class Value
{
    use Validatable;

    abstract public function value();
}
