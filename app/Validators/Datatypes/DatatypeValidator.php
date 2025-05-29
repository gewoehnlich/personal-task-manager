<?php

namespace App\Validators\Datatypes;

use App\Validators\Validator;
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
