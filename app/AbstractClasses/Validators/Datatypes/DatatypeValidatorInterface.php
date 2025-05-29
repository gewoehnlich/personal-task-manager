<?php

namespace App\AbstractClasses\Validators\Datatypes;

use App\AbstractClasses\Validators\Validator;

abstract class DatatypeValidator extends Validator
{
    protected static function isNotNull(
        mixed $value
    ): void {
        //
    }
}
