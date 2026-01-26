<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class FindProjectByUuidAndUserUuidDto extends Dto
{
    public function __construct(
        public readonly ProjectUuidValue $uuid,
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
