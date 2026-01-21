<?php

namespace App\Containers\Bills\Dto;

use App\Ship\Abstracts\Dto\Dto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class DeleteBillDto extends Dto
{
    public function __construct(
        public readonly int $uuid,
        public readonly int $userUuid,
        public readonly int $taskUuid,
    ) {
        //
    }
}
