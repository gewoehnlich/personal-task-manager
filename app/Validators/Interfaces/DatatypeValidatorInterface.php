<?php

namespace App\Validators\Interfaces;

interface DatatypeValidatorInterface // extends ValidatorInterface
{
    public static function validate(
        $value,
        string $field
    );
}
