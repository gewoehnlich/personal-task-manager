<?php

namespace App\Exceptions\Validation\BigIntUnsigned;

use App\Exceptions\Validation\ValidationException;

class UnsignedIntegerFieldValueIsLessThanZero extends ValidationException
{
    public function __construct(
        string $field
    ) {
        $message = "{$field} не может быть меньше 0.";
        parent::__construct($message);
    }
}
