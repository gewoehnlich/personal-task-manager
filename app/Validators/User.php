<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\Validation\Common\{
    AuthorizedUserIdDoesNotEqualToInputtedUserId
};
use App\Interfaces\Validators\Datatypes\DatatypeValidatorInterfaces\{
    IntDatatypeValidatorInterface
};

class User implements IntDatatypeValidatorInterface
{
    public static function validate(
        int $userId,
        string $field
    ): void {
        IntValidator::validate(
            $userId,
            $field
        );

        self::isUserIdEqualToAuthorizedUserId(
            $userId
        );
    }

    private static function isUserIdEqualToAuthorizedUserId(
        int $userId
    ): void {
        $authorizedUserId = Auth::id();
        if ($userId != $authorizedUserId) {
            throw new AuthorizedUserIdDoesNotEqualToInputtedUserId(
                $userId,
                $authorizedUserId
            );
        }
    }
}
