<?php

namespace App\Exceptions\Validation\Text;

use App\Exceptions\Validation\ValidationException;

class TextFieldValueTooLong extends ValidationException
{
    public function __construct(
        string $field
    ) {
        $message = "{$field} не может быть длиннее 65535 символов.";
        parent::__construct($message);
    }
}
