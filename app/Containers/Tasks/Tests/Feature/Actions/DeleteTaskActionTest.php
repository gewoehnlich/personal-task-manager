<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

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

        $task = Task::factory()->for($user)->create();

        $data = [
            'uuid' => $task->uuid,
            'user_uuid' => $user->uuid,
        ];

        $this->action(
            class: DeleteTaskAction::class,
            dto: DeleteTaskDto::from(
                data: $data,
            ),
        );

        $this->assertSoftDeleted(
            table: 'tasks',
            data: $data,
        );
    }
}
