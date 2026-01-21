<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\Stage;
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
#[CoversClass(IndexTasksAction::class)]
#[Medium]
#[UsesClass(IndexTasksDto::class)]
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
            new IndexTasksDto(
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
            new IndexTasksDto(
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
            new IndexTasksDto(
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

    #[TestDox('action index tasks by stage')]
    public function testIndexTasksByStage(): void
    {
        $user = User::factory()->create();

        Task::factory()
            ->for($user)
            ->sequence(
                ['stage' => Stage::PENDING->value],
                ['stage' => Stage::ACTIVE->value],
                ['stage' => Stage::DONE->value],
            )
            ->count(6)
            ->create();

        $response = $this->action(
            IndexTasksAction::class,
            new IndexTasksDto(
                userUuid: $user->uuid,
                stage: Stage::PENDING,
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('stage', Stage::PENDING->value)
                ->get(),
            actual: $response->data,
            message: 'action indexes tasks by stage wrong',
        );
    }

    #[TestDox('action index tasks by project_uuid')]
    public function testIndexTasksByProjectUuid(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $project2 = Project::factory()
            ->for($user)
            ->create();

        Task::factory()
            ->for($user)
            ->for($project)
            ->count(3)
            ->create();

        Task::factory()
            ->for($user)
            ->for($project2)
            ->count(3)
            ->create();

        $response = $this->action(
            IndexTasksAction::class,
            new IndexTasksDto(
                userUuid: $user->uuid,
                projectUuid: $project->uuid,
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('project_uuid', $project->uuid)
                ->get(),
            actual: $response->data,
            message: 'action indexes tasks by project_uuid wrong',
        );
    }

    // #[TestDox('action index tasks by created_at range')]
    // public function testIndexTasksByCreatedAtRange(): void
    // {
    //     $user = User::factory()
    //         ->create();
    //
    //     for ($day = 1; $day >= 7; ++$day) {
    //         Task::factory()
    //             ->for($user)
    //             ->
    //             ->create();
    //     }
    //
    //     $response = $this->action(
    //         IndexTasksAction::class,
    //         new IndexTasksDto(
    //             userUuid: $user->uuid,
    //             projectUuid: $project->uuid,
    //         ),
    //     );
    //
    //     $this->assertEquals(
    //         expected: Task::query()
    //             ->where('user_uuid', $user->uuid)
    //             ->where('project_uuid', $project->uuid)
    //             ->get(),
    //         actual: $response->data,
    //         message: 'action indexes tasks by project_uuid wrong',
    //     );
    // }
}
