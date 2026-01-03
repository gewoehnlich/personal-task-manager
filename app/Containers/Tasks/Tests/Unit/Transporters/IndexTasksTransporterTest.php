<?php

namespace App\Containers\Tasks\Tests\Unit\Transporters;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexTasksTransporter::class)]
#[Small]
final class IndexTasksTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
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
        $transporter = new IndexTasksTransporter(
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
                'user_uuid'       => $transporter->userUuid,
                'uuid'            => $transporter->uuid,
                'stage'           => $transporter->stage?->value,
                'project_uuid'    => $transporter->projectUuid,
                'created_at_from' => $transporter->createdAtFrom?->toIso8601String(),
                'created_at_to'   => $transporter->createdAtTo?->toIso8601String(),
                'updated_at_from' => $transporter->updatedAtFrom?->toIso8601String(),
                'updated_at_to'   => $transporter->updatedAtTo?->toIso8601String(),
                'deadline_from'   => $transporter->deadlineFrom?->toIso8601String(),
                'deadline_to'     => $transporter->deadlineTo?->toIso8601String(),
                'order_by'        => $transporter->orderBy,
                'order_by_field'  => $transporter->orderByField,
                'limit'           => $transporter->limit,
                'with_deleted'    => $transporter->withDeleted,
            ],
            actual: $transporter->toArray(),
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
