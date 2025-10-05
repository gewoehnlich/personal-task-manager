<?php

namespace App\Containers\Bills\Transporters;

use App\Ship\Parents\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class BillGetTransporter extends Transporter
{
    public function __construct(
        public readonly int $taskId,
    ) {
        //
    }
}
