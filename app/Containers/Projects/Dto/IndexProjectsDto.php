<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final readonly class IndexProjectsDto extends Dto
{
    public function __construct(
        public readonly UserUuidValue $userUuid,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function toArray(): array
    {
        return [
            'user_uuid' => $this->userUuid(),
        ];
    }

    public static function from(
        array $data,
    ): self {
        return new self(
            userUuid: new UserUuidValue(
                uuid: $data['user_uuid'],
            ),
        );
    }
}
