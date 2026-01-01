<?php

namespace App\Containers\Projects\Tests\Unit\Transporters;

use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DeleteProjectTransporter::class)]
#[Small]
final class DeleteProjectTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $uuid,
        string $userUuid,
    ): void {
        $transporter = new DeleteProjectTransporter(
            uuid: $uuid,
            userUuid: $userUuid,
        );

        $this->assertSame(
            expected: [
                'uuid'      => $uuid,
                'user_uuid' => $userUuid,
            ],
            actual: $transporter->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'data' => [
                '019b6eb2-ef9a-70b8-999e-e6835a07e4d2', // uuid
                '219b6eb2-ef9a-70b8-999e-e6835a07e4d2', // userUuid
            ],
        ];
    }
}
