<?php

namespace App\Interfaces\Validators\Datatypes\DatatypeValidatorInterfaces;

use App\Interfaces\Validators\Datatypes\DatatypeValidatorInterface;

interface StringDatatypeValidatorInterface extends DatatypeValidatorInterface
{
    public static function validate(
        string $value,
        string $field
    ): void;
}
