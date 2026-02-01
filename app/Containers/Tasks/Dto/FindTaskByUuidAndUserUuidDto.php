<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class FindTaskByUuidAndUserUuidDto extends Dto
{
    public function __construct(
        public readonly TaskUuidValue $uuid,
        public readonly UserUuidValue $userUuid,
    ) {
        //
    }

    public function uuid(): string
    {
        return $this->uuid->uuid;
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid(),
            'user_uuid'   => $this->userUuid(),
        ];
    }
}
