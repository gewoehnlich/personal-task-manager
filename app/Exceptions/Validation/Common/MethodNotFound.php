<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class MethodNotFound extends ValidationException
{
    public function __construct(
        string $method,
        string $class
    ) {
        $message = "Не найден метод {$class}->{$method}.";
        parent::__construct($message);
    }
}
