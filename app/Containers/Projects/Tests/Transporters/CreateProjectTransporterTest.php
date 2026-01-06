<?php

namespace App\Containers\Projects\Tests\Transporters;

use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(CreateProjectTransporter::class)]
#[Small]
final class CreateProjectTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
        string $title,
        ?string $description,
    ): void {
        $transporter = new CreateProjectTransporter(
            userUuid: $userUuid,
            title: $title,
            description: $description,
        );

        $this->assertSame(
            expected: [
                'user_uuid'   => $userUuid,
                'title'       => $title,
                'description' => $description,
            ],
            actual: $transporter->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                'title',                                // title
                'description',                          // description
            ],
            'null description' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
                'title',                                // title
                null,                                   // description
            ],
        ];
    }
}
