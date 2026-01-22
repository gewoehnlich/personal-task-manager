<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\Stage;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexTasksDto::class)]
#[Small]
final class IndexTasksDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
        ?string $uuid,
        ?Stage $stage,
        ?string $projectUuid,
        ?Carbon $createdAtFrom,
        ?Carbon $createdAtTo,
        ?Carbon $updatedAtFrom,
        ?Carbon $updatedAtTo,
        ?Carbon $deadlineFrom,
        ?Carbon $deadlineTo,
        ?string $orderBy,
        ?string $orderByField,
        ?int $limit,
        ?bool $withDeleted,
    ): void {
        $dto = new IndexTasksDto(
            userUuid: $userUuid,
            uuid: $uuid,
            stage: $stage,
            projectUuid: $projectUuid,
            createdAtFrom: $createdAtFrom,
            createdAtTo: $createdAtTo,
            updatedAtFrom: $updatedAtFrom,
            updatedAtTo: $updatedAtTo,
            deadlineFrom: $deadlineFrom,
            deadlineTo: $deadlineTo,
            orderBy: $orderBy,
            orderByField: $orderByField,
            limit: $limit,
            withDeleted: $withDeleted,
        );

        $this->assertSame(
            expected: [
                'user_uuid'       => $dto->userUuid,
                'uuid'            => $dto->uuid,
                'stage'           => $dto->stage?->value,
                'project_uuid'    => $dto->projectUuid,
                'created_at_from' => $dto->createdAtFrom?->toIso8601String(),
                'created_at_to'   => $dto->createdAtTo?->toIso8601String(),
                'updated_at_from' => $dto->updatedAtFrom?->toIso8601String(),
                'updated_at_to'   => $dto->updatedAtTo?->toIso8601String(),
                'deadline_from'   => $dto->deadlineFrom?->toIso8601String(),
                'deadline_to'     => $dto->deadlineTo?->toIso8601String(),
                'order_by'        => $dto->orderBy,
                'order_by_field'  => $dto->orderByField,
                'limit'           => $dto->limit,
                'with_deleted'    => $dto->withDeleted,
            ],
            actual: $dto->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // uuid
                Stage::PENDING,                         // stage
                '619b6eb2-ef9a-70b8-999e-e6835a07e4d2', // projectUuid
                Carbon::now(),                          // createdAtFrom
                Carbon::now(),                          // createdAtTo
                Carbon::now(),                          // updatedAtFrom
                Carbon::now(),                          // updatedAtTo
                Carbon::now(),                          // deadlineFrom
                Carbon::now(),                          // deadlineTo
                'asc',                                  // orderBy
                'id',                                   // orderByField
                1,                                      // limit
                true,                                   // withDeleted
            ],
            'all nullable parameters are null' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                null,                                   // uuid
                null,                                   // stage
                null,                                   // projectUuid
                null,                                   // createdAtFrom
                null,                                   // createdAtTo
                null,                                   // updatedAtFrom
                null,                                   // updatedAtTo
                null,                                   // deadlineFrom
                null,                                   // deadlineTo
                null,                                   // orderBy
                null,                                   // orderByField
                null,                                   // limit
                null,                                   // withDeleted
            ],
        ];
    }
}
