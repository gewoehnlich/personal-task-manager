<?php

namespace App\Containers\Bills\Transporters;

use App\Ship\Abstracts\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class DeleteBillTransporter extends Transporter
{
    public function __construct(
        public readonly int $uuid,
        public readonly int $userUuid,
        public readonly int $taskUuid,
    ) {
        //
    }
}
