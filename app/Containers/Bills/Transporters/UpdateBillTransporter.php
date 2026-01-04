<?php

namespace App\Containers\Bills\Transporters;

use App\Ship\Abstracts\Transporters\Transporter;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class UpdateBillTransporter extends Transporter
{
    public function __construct(
        public readonly int $uuid,
        public readonly int $userUuid,
        public readonly int $taskUuid,
        public readonly ?string $description = null,
        public readonly ?int $timeSpent = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $performedAt = null,
    ) {
        //
    }
}
