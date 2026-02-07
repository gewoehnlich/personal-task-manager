<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
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
        $user = User::factory()
            ->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $data = [
            'uuid'      => $task->uuid,
            'user_uuid' => $user->uuid,
        ];

        $dto = DeleteTaskDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
        );
    }
}
