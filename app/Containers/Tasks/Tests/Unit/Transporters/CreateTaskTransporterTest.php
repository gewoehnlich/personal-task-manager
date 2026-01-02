<?php

namespace App\Containers\Tasks\Tests\Unit\Transporters;

use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Transporters\CreateTaskTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(CreateTaskTransporter::class)]
#[Small]
final class CreateTaskTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
        string $title,
        ?string $description,
        Stage $stage,
        ?Carbon $deadline,
        ?string $projectUuid,
    ): void {
        $transporter = new CreateTaskTransporter(
            userUuid: $userUuid,
            title: $title,
            description: $description,
            stage: $stage,
            deadline: $deadline,
            projectUuid: $projectUuid,
        );

        $this->assertSame(
            expected: [
                'user_uuid'    => $userUuid,
                'title'        => $title,
                'description'  => $description,
                'stage'        => $stage->value,
                'deadline'     => $deadline?->toIso8601String(),
                'project_uuid' => $projectUuid,
            ],
            actual: $transporter->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                'name',                                 // name
                'description',                          // description
                Stage::PENDING,                         // stage,
                Carbon::now(),                          // deadline
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // projectUuid
            ],
            'nullable parameters are null' => [
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
