<?php

namespace App\AbstractClasses\Validators\Datatypes;

use App\AbstractClasses\Validators\Validator;
use App\Exceptions\Validation\Common\PropertyValueIsNull;

abstract class DatatypeValidator extends Validator
{
    protected static function isNotNull(
        mixed $value
    ): void {
        if (is_null($value)) {
            throw new PropertyValueIsNull();
        }
    }
}
