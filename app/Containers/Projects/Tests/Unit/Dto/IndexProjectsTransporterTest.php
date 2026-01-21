<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexProjectsDto::class)]
#[Small]
final class IndexProjectsDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
    ): void {
        $dto = new IndexProjectsDto(
            userUuid: $userUuid,
        );

        $this->assertSame(
            expected: [
                'user_uuid' => $userUuid,
            ],
            actual: $dto->toArray(),
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
