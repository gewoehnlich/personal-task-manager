<?php

namespace App\Containers\Tasks\Tests\Feature\Repositories;

use App\Containers\Tasks\Exceptions\TaskDoesNotBelongToAuthenticatedUserException;
use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(TaskRepository::class)]
#[Medium]
final class TaskRepositoryTest extends TestCase
{
    public function testByUuidMethodWithExistingTaskShouldReturnThisTask(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $result = $this->taskRepository->byUuid(
            uuid: $task->uuid,
        );

        $this->assertSame(
            expected: $result->uuid,
            actual: $task->uuid,
            message: 'task from the TaskRepository should be the same as expected',
        );
    }

    public function testByUuidMethodWithNonexistentTaskShouldThrowAnException(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: TaskWithThisUuidDoesNotExistException::class,
        );

        $this->taskRepository->byUuid(
            uuid: $user->uuid, // not task uuid
        );
    }

    public function testByUuidMethodWithTaskThatBelongToAnotherUserShouldThrowAnException(): void
    {
        $user = $this->user();

        $user2 = $this->user();

        // authenticated as another user
        $this->actingAs(
            user: $user2,
        );

        $task = $this->task(
            user: $user,
        );

        $this->expectException(
            exception: TaskDoesNotBelongToAuthenticatedUserException::class,
        );

        $this->taskRepository->byUuid(
            uuid: $task->uuid, // not task uuid
        );
    }
}
