<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Users\Models\User;
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
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $user = User::factory()->create();

        $dto = IndexProjectsDto::from([
            'user_uuid' => $user->uuid,
        ]);

        $this->assertSame(
            expected: [
                'user_uuid' => $user->uuid,
            ],
            actual: $dto->toArray(),
        );
    }

    #[TestDox('userUuid() method should return a string')]
    public function testUserUuidMethod(): void
    {
        $user = User::factory()
            ->create();

        $data = [
            'user_uuid' => $user->uuid,
        ];

        $dto = IndexProjectsDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->userUuid->uuid,
            actual: $dto->userUuid(),
            message: 'userUuid() method should return actual value',
        );
    }
}
