<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class KeyNotFound extends ValidationException
{
    public function __construct(
        string $key
    ) {
        $message = "Не найден ключ {$key} в TaskValidator::HASHMAP";
        parent::__construct($message);
    }
}
