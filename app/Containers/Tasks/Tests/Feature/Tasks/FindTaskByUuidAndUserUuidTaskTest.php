<?php

namespace App\Containers\Tasks\Tests\Feature\Tasks;

use App\Containers\Tasks\Dto\FindTaskByUuidAndUserUuidDto;
use App\Containers\Tasks\Exceptions\TaskDoesNotBelongToAuthenticatedUserException;
use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Tasks\FindTaskByUuidAndUserUuidTask;
use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Users\Models\User;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(FindTaskByUuidAndUserUuidTask::class)]
#[Medium]
#[UsesClass(FindTaskByUuidAndUserUuidDto::class)]
final class FindTaskByUuidAndUserUuidTaskTest extends TestCase
{
    #[TestDox('task should find the task with valid uuid and valid user uuid')]
    public function testValidUuidAndValidUserUuid(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()->for($user)->create();

        $response = $this->task(
            class: FindTaskByUuidAndUserUuidTask::class,
            dto: new FindTaskByUuidAndUserUuidDto(
                uuid: new TaskUuidValue(
                    uuid: $task->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user->uuid,
                ),
            ),
        );

        $this->assertSame(
            expected: $task->uuid,
            actual: $response->uuid,
            message: 'task should return the task with the same uuid as inputted',
        );

        $this->assertSame(
            expected: $user->uuid,
            actual: $response->user_uuid,
            message: 'task should return the task with the right user',
        );
    }

    #[TestDox('task should find the task with valid uuid and invalid user uuid')]
    public function testValidUuidAndInvalidUserUuid(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()->for($user)->create();

        $user2 = User::factory()->create();

        $this->expectException(
            exception: TaskDoesNotBelongToAuthenticatedUserException::class,
        );

        $this->task(
            class: FindTaskByUuidAndUserUuidTask::class,
            dto: new FindTaskByUuidAndUserUuidDto(
                uuid: new TaskUuidValue(
                    uuid: $task->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user2->uuid,
                ),
            ),
        );
    }

    #[TestDox('task should find the task with invalid uuid')]
    public function testInvalidUuid(): void
    {
        $user = User::factory()->create();

        $this->expectException(
            exception: TaskWithThisUuidDoesNotExistException::class,
        );

        $this->task(
            class: FindTaskByUuidAndUserUuidTask::class,
            dto: new FindTaskByUuidAndUserUuidDto(
                uuid: new TaskUuidValue(
                    uuid: $user->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user->uuid,
                ),
            ),
        );
    }
}
