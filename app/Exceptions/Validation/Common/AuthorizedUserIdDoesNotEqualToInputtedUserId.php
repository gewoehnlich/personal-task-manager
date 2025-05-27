<?php

namespace App\Exceptions\Validation\Common;

use App\Exceptions\Validation\ValidationException;

class AuthorizedUserIdDoesNotEqualToInputtedUserId extends ValidationException
{
    public function __construct(
        string $inputtedUserId,
        string $authorizedUserId
    ) {
        $message =
            '\'userId\' не соответствует ID авторизованного пользователя.\n' .
            "Введенный userId: {$inputtedUserId}\n" .
            "Настоящий userId: {$authorizedUserId}"
        ;

        parent::__construct($message);
    }
}
