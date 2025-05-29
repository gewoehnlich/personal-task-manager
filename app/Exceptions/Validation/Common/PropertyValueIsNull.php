<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class PropertyValueIsNull extends ValidationException
{
    public function __construct()
    {
        $message = "Значение не может быть null.";
        parent::__construct($message);
    }
}
