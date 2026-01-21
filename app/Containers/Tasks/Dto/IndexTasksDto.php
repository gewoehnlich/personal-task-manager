<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Tasks\Enums\Stage;
use App\Ship\Abstracts\Dto\Dto;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class IndexTasksDto extends Dto
{
    public function __construct(
        public readonly string $userUuid,
        public readonly ?string $uuid = null,
        public readonly ?Stage $stage = null,
        public readonly ?string $projectUuid = null,
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
}
