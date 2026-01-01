<?php

namespace App\Containers\Tasks\Transporters;

use App\Ship\Abstracts\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class DeleteTaskTransporter extends Transporter
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
    ) {
        //
    }
}
