<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class IndexProjectsDto extends Dto
{
    public function __construct(
        public readonly User $user,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function toArray(): array
    {
        return [
            'user_uuid' => $this->userUuid(),
        ];
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            user: $inputData['user'],
        );
    }
}
