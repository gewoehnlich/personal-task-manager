<?php

namespace App\AbstractClasses\Validators\Datatypes\DatatypeValidators;

use App\AbstractClasses\Validators\Datatypes\DatatypeValidator;

abstract class IntValidator extends DatatypeValidator
{
    public static function validate(
        int $value,
        string $field
    ): void {
        //
    }
}
