<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class KeyNotFound extends ValidationException
{
    public function __construct(
        string $key,
        string $class
    ) {
        $message = "Не найден ключ {$key} в {$class}::HASHMAP";
        parent::__construct($message);
    }
}
