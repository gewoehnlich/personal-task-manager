<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\UpdateTaskDto;
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
#[CoversClass(UpdateTaskDto::class)]
#[Small]
final class UpdateTaskDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $uuid,
        string $userUuid,
        string $title,
        ?string $description,
        Stage $stage,
        ?Carbon $deadline,
        ?string $projectUuid,
    ): void {
        $dto = new UpdateTaskDto(
            uuid: $uuid,
            userUuid: $userUuid,
            title: $title,
            description: $description,
            stage: $stage,
            deadline: $deadline,
            projectUuid: $projectUuid,
        );

        $this->assertSame(
            expected: [
                'uuid'         => $uuid,
                'user_uuid'    => $userUuid,
                'title'        => $title,
                'description'  => $description,
                'stage'        => $stage->value,
                'deadline'     => $deadline?->toIso8601String(),
                'project_uuid' => $projectUuid,
            ],
            actual: $dto->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // uuid
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                'name',                                 // name
                'description',                          // description
                Stage::PENDING,                         // stage,
                Carbon::now(),                          // deadline
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // projectUuid
            ],
            'all nullable parameters are null' => [
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // uuid
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                'name',                                 // name
                null,                                   // description
                Stage::PENDING,                         // stage,
                null,                                   // deadline
                null,                                   // projectUuid
            ],
        ];
    }
}
