<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class StringFieldIsEmpty extends ValidationException
{
    public function __construct(
        string $field
    ) {
        $message = "{$field} не может быть пустым.";
        parent::__construct($message);
    }
}
