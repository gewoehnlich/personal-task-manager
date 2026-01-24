<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final readonly class IndexTasksDto extends Dto
{
    public function __construct(
        public readonly UserUuidValue $userUuid,
        public readonly ?TaskUuidValue $uuid = null,
        public readonly ?Stage $stage = null,
        public readonly ?ProjectUuidValue $projectUuid = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $createdAtFrom = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $createdAtTo = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updatedAtFrom = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updatedAtTo = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $deadlineFrom = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $deadlineTo = null,
        public readonly ?string $orderBy = null,
        public readonly ?string $orderByField = null,
        public readonly ?int $limit = null,
        public readonly ?bool $withDeleted = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function uuid(): string
    {
        return $this->uuid->uuid;
    }

    public function toArray(): array
    {
        return [
            'uuid'      => $this->uuid(),
            'user_uuid' => $this->userUuid(),
        ];
    }

    public static function from(
        array $data,
    ): self {
        return new self(
            uuid: new TaskUuidValue(
                uuid: $data['uuid'],
            ),
            userUuid: new UserUuidValue(
                uuid: $data['user_uuid'],
            ),
        );
    }
}
