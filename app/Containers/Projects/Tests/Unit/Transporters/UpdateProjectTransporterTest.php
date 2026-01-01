<?php

namespace App\Containers\Projects\Tests\Unit\Transporters;

use App\Containers\Projects\Transporters\UpdateProjectTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(UpdateProjectTransporter::class)]
#[Small]
final class UpdateProjectTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $uuid,
        string $userUuid,
        ?string $name,
        ?string $description,
    ): void {
        $transporter = new UpdateProjectTransporter(
            uuid: $uuid,
            userUuid: $userUuid,
            name: $name,
            description: $description,
        );

        $this->assertSame(
            expected: [
                'uuid'        => $uuid,
                'user_uuid'   => $userUuid,
                'name'        => $name,
                'description' => $description,
            ],
            actual: $transporter->toArray(),
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
            ],
            'null name and description' => [
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // uuid
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                null,                                   // name
                null,                                   // description
            ],
        ];
    }
}
