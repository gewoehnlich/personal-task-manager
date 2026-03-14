<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexProjectsDto::class)]
#[Small]
final class IndexProjectsDtoTest extends TestCase
{
    #[TestDox('from() method should create the dto')]
    public function testFromMethodDtoCreation(): void
    {
        $user = $this->user();

        $dto = IndexProjectsDto::from([
            'user' => $user,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
            message: "dto user should be the same as expected",
        );
    }

    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $user = $this->user();

        $dto = IndexProjectsDto::from([
            'user' => $user,
        ]);

        $this->assertSame(
            expected: [
                'user_uuid' => $user->uuid,
            ],
            actual: $dto->toArray(),
            message: "toArray() should return the same array as expected",
        );
    }
}
