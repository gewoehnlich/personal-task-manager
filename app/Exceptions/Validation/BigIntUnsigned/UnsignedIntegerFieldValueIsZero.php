<?php

namespace App\Exceptions\Validation\BigIntUnsigned;

use App\Exceptions\Validation\ValidationException;

class UnsignedIntegerFieldValueIsEqualToZero extends ValidationException
{
    public function __construct(
        string $field
    ) {
        $message = "{$field} не может быть равно 0.";
        parent::__construct($message);
    }
}
