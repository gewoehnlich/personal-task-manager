<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(DeleteTaskAction::class)]
#[Medium]
#[UsesClass(DeleteTaskDto::class)]
final class DeleteTaskActionTest extends TestCase
{
    #[TestDox('action deletes a task')]
    public function testAction(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->for($user)->create();

        $task = Task::factory()->for($user)->create();

        $this->action(
            DeleteTaskAction::class,
            new DeleteTaskDto(
                uuid: $task->uuid,
                userUuid: $user->uuid,
            ),
        );

        $this->assertSoftDeleted(
            table: 'tasks',
            data: [
                'uuid'      => $task->uuid,
                'user_uuid' => $user->uuid,
            ],
        );
    }
}
