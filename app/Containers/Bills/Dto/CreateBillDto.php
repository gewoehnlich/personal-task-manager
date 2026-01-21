<?php

namespace App\Containers\Bills\Dto;

use App\Ship\Abstracts\Dto\Dto;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class CreateBillDto extends Dto
{
    public function __construct(
        public readonly int $userUuid,
        public readonly int $taskUuid,
        public readonly ?string $description = null,
        public readonly int $timeSpent,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon $performedAt,
    ) {
        //
    }
}
