<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DeleteTaskDto::class)]
#[Small]
final class DeleteTaskDtoTest extends TestCase
{
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $dto = new DeleteTaskDto(
            uuid: '219b6eb2-ef9a-70b8-999e-e6835a07e4d2',
            userUuid: '019b6eb2-ef9a-70b8-999e-e6835a07e4d2',
        );

        $this->assertSame(
            expected: [
                'uuid'      => $dto->uuid,
                'user_uuid' => $dto->userUuid,
            ],
            actual: $dto->toArray(),
        );
    }
}
