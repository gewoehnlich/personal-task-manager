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
final class UpdateTaskDto extends Dto
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $userUuid,
        public readonly string $title,
        public readonly ?string $description = null,
        public readonly Stage $stage,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $deadline = null,
        public readonly ?string $projectUuid = null,
    ) {
        //
    }
}
