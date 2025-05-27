<?php

namespace App\Exceptions\Validation\Varchar255;

use App\Exceptions\Validation\ValidationException;

class Varchar255FieldValueTooLong extends ValidationException
{
    public function __construct(
        string $field
    ) {
        $message = "{$field} не может быть длиннее 255 символов.";
        parent::__construct($message);
    }
}
