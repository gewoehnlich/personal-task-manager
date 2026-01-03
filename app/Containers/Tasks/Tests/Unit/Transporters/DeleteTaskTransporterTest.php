<?php

namespace App\Containers\Tasks\Tests\Unit\Transporters;

use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DeleteTaskTransporter::class)]
#[Small]
final class DeleteTaskTransporterTest extends TestCase
{
    #[TestDox('converts transporter properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $transporter = new DeleteTaskTransporter(
            uuid: '219b6eb2-ef9a-70b8-999e-e6835a07e4d2',
            userUuid: '019b6eb2-ef9a-70b8-999e-e6835a07e4d2',
        );

        $this->assertSame(
            expected: [
                'uuid'      => $transporter->uuid,
                'user_uuid' => $transporter->userUuid,
            ],
            actual: $transporter->toArray(),
        );
    }
}
