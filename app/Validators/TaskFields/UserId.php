<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\MySQL\UnsignedIntegerValidator;
use App\Exceptions\Validation\BigIntUnsigned\{
    UnsignedIntegerFieldValueIsEqualToZero
};
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Validation\Common\{
    AuthorizedUserIdDoesNotEqualToInputtedUserId
};

abstract class UserId extends UnsignedIntegerValidator
{
    public static function validate(
        int $userId
    ): void {
        UnsignedIntegerValidator::validate(
            $userId
        );

        self::isNotEqualToZero(
            $userId
        );

        /*self::isUserIdEqualToAuthorizedUserId(*/
        /*    $userId*/
        /*);*/
    }

    private static function isNotEqualToZero(
        int $userId
    ): void {
        if ($userId === 0) {
            throw new UnsignedIntegerFieldValueIsEqualToZero();
        }
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
