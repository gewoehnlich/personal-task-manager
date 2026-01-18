<?php

namespace App\Containers\Users\Values;

use App\Containers\Users\Exceptions\UserWithThisUuidDoesNotExistException;
use App\Containers\Users\Models\User;
use App\Ship\Values\UuidValue;

final readonly class UserUuidValue extends UuidValue
{
    protected function validate(): void
    {
        parent::validate();

        $this->doesUserWithThisUuidExist();
    }

    private function doesUserWithThisUuidExist(): void
    {
        $user = User::query()
            ->where('uuid', $this->uuid)
            ->first();

        if ($user === null) {
            throw new UserWithThisUuidDoesNotExistException(
                uuid: $this->uuid,
            );
        }
    }
}
