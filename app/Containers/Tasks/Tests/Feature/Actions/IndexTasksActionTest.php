<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(IndexTasksAction::class)]
#[Medium]
#[UsesClass(IndexTasksTransporter::class)]
final class IndexTasksActionTest extends TestCase
{
    #[TestDox('action indexes tasks by user_uuid')]
    public function testIndexingTasksByUserUuid(): void
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        Task::factory()
            ->for($user2)
            ->count(3)
            ->create();

        $response = $this->action(
            IndexTasksAction::class,
            new IndexTasksTransporter(
                userUuid: $user->uuid,
            ),
        );

        $this->assertEquals(
            expected: Task::where('user_uuid', $user->uuid)->get(),
            actual: $response->data,
            message: 'action indexes tasks by user_uuid wrong',
        );
    }

    #[TestDox('action indexes tasks by uuid')]
    public function testIndexingTasksByUuid(): void
    {
        $user = User::factory()->create();

        Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $response = $this->action(
            IndexTasksAction::class,
            new IndexTasksTransporter(
                userUuid: $user->uuid,
                uuid: $task->uuid,
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('uuid', $task->uuid)
                ->where('user_uuid', $user->uuid)
                ->get()
                ->isNotEmpty(),
            actual: $response->data
                ->isNotEmpty(),
            message: 'action indexes tasks by uuid wrong',
        );
    }

    #[TestDox('action does not index tasks of one user for another user by task uuid')]
    public function testIndexingTasksOfOneUserForAnotherUserByUuid(): void
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $response = $this->action(
            IndexTasksAction::class,
            new IndexTasksTransporter(
                userUuid: $user2->uuid,
                uuid: $task->uuid,
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('uuid', $task->uuid)
                ->where('user_uuid', $user2->uuid)
                ->get()
                ->isEmpty(),
            actual: $response->data
                ->isEmpty(),
            message: 'action indexing tasks by uuid returns tasks of one user to another user',
        );
    }
}
