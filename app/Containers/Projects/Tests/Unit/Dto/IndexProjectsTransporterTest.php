<?php

namespace App\Containers\Projects\Tests\Unit\Transporters;

use App\Containers\Projects\Transporters\IndexProjectsTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexProjectsTransporter::class)]
#[Small]
final class IndexProjectsTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
    ): void {
        $transporter = new IndexProjectsTransporter(
            userUuid: $userUuid,
        );

        $this->assertSame(
            expected: [
                'user_uuid' => $userUuid,
            ],
            actual: $transporter->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'data' => [
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
            ],
        ];
    }
}
