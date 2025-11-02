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
final class TaskUpdateTransporter extends Transporter
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $title,
        public readonly string $description,
        public readonly Stage $stage,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly Carbon $deadline,
    ) {
        //
    }
}
