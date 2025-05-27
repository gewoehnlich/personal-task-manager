<?php

namespace App\Exceptions\Validation\Enum;

use App\Exceptions\Validation\ValidationException;

class NotValidTaskStatus extends ValidationException
{
    public function __construct(
        string $taskStatus,
        array $validStatuses
    ) {
        $message =
            "\'taskStatus\' значение {$taskStatus} неправильное.\n" .
            "Допустимые значения: {$validStatuses}."
        ;

        parent::__construct($message);
    }
}
