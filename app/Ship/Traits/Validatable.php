<?php

namespace App\Ship\Traits;

trait Validatable
{
    abstract protected function validate(): void;
}
