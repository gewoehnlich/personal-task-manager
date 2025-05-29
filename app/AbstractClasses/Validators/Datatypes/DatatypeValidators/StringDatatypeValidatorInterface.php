<?php

namespace App\AbstractClasses\Validators\Datatypes\DatatypeValidators;

use App\AbstractClasses\Validators\Datatypes\DatatypeValidator;

abstract class StringValidator extends DatatypeValidator
{
    public static function validate(
        string $value,
        string $field
    ): void {
        //
    }
}
