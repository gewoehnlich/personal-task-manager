<?php

namespace App\Containers\Bills\Transporters;

use App\Ship\Parents\Transporters\Transporter;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class BillUpdateTransporter extends Transporter
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly int $taskId,
        public readonly ?string $description,
        public readonly int $timeSpent,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $performedAt,
    ) {
        //
    }
}
