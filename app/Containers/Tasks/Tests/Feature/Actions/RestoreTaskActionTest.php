<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Tasks\Actions\RestoreTaskAction;
use App\Containers\Tasks\Dto\RestoreTaskDto;
use App\Containers\Tasks\Exceptions\TaskIsNotSoftDeletedException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(RestoreTaskAction::class)]
#[Medium]
#[UsesClass(RestoreTaskDto::class)]
final class RestoreTaskActionTest extends TestCase
{
    public function testActionRestoresTaskWhenTaskIsSoftDeleted(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $task->delete(); // soft deleted

        $this->action(
            class: RestoreTaskAction::class,
            dto: RestoreTaskDto::from([
                'uuid' => $task->uuid,
            ]),
        );

        $this->assertNotSoftDeleted('tasks', [
            'uuid' => $task->uuid,
        ]);
    }

    public function testActionThrowsAnExceptionWhenTaskIsNotSoftDeleted(): void
    {
        $user = $this->user();

        // not soft deleted
        $task = $this->task(
            user: $user,
        );

        $this->expectException(
            exception: TaskIsNotSoftDeletedException::class,
        );

        $this->action(
            class: RestoreTaskAction::class,
            dto: RestoreTaskDto::from([
                'uuid' => $task->uuid,
            ]),
        );
    }
}
