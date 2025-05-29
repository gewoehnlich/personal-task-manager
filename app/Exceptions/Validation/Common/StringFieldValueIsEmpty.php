<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class StringFieldValueIsEmpty extends ValidationException
{
    public function __construct()
    {
        $message = "Значение не может быть пустым.";
        parent::__construct($message);
    }
}
