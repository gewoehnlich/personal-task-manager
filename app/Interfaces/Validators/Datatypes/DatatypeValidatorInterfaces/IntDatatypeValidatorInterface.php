<?php

namespace App\Interfaces\Validators\Datatypes\DatatypeValidatorInterfaces;

use App\Interfaces\Validators\Datatypes\DatatypeValidatorInterface;

interface IntDatatypeValidatorInterface extends DatatypeValidatorInterface
{
    public static function validate(
        int $value,
        string $field
    );
}
