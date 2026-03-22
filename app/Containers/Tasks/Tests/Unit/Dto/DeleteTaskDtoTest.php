<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(DeleteTaskDto::class)]
#[Small]
final class DeleteTaskDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithExistingTaskUuid(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $force = false;

        $dto = DeleteTaskDto::from([
            'uuid'  => $task->uuid,
            'user'  => $user,
            'force' => $force,
        ]);

        $this->assertEquals(
            expected: $task->uuid,
            actual: $dto->taskUuid(),
            message: 'task should be the same as expected',
        );

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->userUuid(),
            message: 'user should be the same as expected',
        );

        $this->assertEquals(
            expected: $force,
            actual: $dto->force(),
            message: 'force should be the same as expected',
        );
    }
}
