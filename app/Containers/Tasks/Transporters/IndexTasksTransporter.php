<?php

namespace App\Containers\Tasks\Transporters;

use App\Containers\Tasks\Enums\Stage;
use App\Ship\Parents\Transporters\Transporter;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class IndexTasksTransporter extends Transporter
{
    public function __construct(
        public readonly int $userId,
        public readonly ?int $id,
        public readonly ?Stage $stage,
        public readonly ?int $projectId,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $createdAtFrom,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $createdAtTo,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updatedAtFrom,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updatedAtTo,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $deadlineFrom,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $deadlineTo,
        public readonly ?string $orderBy,
        public readonly ?string $orderByField,
        public readonly ?int $limit,
    ) {
        //
    }
}
