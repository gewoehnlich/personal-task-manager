<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(DeleteTaskAction::class)]
#[Medium]
#[UsesClass(DeleteTaskDto::class)]
final class DeleteTaskActionTest extends TestCase
{
    public function testActionSoftDeletesTheTask(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $this->action(
            class: DeleteTaskAction::class,
            dto: DeleteTaskDto::from([
                'uuid'  => $task->uuid,
                'force' => false, // force is false
            ]),
        );

        $this->assertSoftDeleted('tasks', [
            'uuid' => $task->uuid,
        ]);
    }

    public function testActionForceDeletesTheTaskIfForceParameterIsTrue(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $this->action(
            class: DeleteTaskAction::class,
            dto: DeleteTaskDto::from([
                'uuid'  => $task->uuid,
                'force' => true, // force is true
            ]),
        );

        $this->assertDatabaseMissing('tasks', [
            'uuid' => $task->uuid,
        ]);
    }
}
