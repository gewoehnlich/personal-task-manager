<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
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
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                ],
            ),
        );

        $this->assertEquals(
            expected: Task::where('user_uuid', $user->uuid)->get(),
            actual: $response,
            message: 'action should index tasks by user_uuid',
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
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'uuid' => $task->uuid,
                ],
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('uuid', $task->uuid)
                ->where('user_uuid', $user->uuid)
                ->get(),
            actual: $response,
            message: 'action should index tasks by uuid',
        );
    }

    #[TestDox('action should not index tasks of one user for another user by task uuid')]
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
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user2->uuid,
                    'uuid' => $task->uuid,
                ],
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('uuid', $task->uuid)
                ->where('user_uuid', $user2->uuid)
                ->get(),
            actual: $response,
            message: 'action should not index tasks of one user to another user by task uuid',
        );
    }

    #[TestDox('action should index tasks by stage')]
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
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'stage' => Stage::PENDING->value,
                ],
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('stage', Stage::PENDING->value)
                ->get(),
            actual: $response,
            message: 'action should index tasks by stage',
        );
    }

    #[TestDox('action should index tasks by project_uuid')]
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
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'project_uuid' => $project->uuid,
                ],
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('project_uuid', $project->uuid)
                ->get(),
            actual: $response,
            message: 'action should index tasks by project_uuid',
        );
    }

    #[TestDox('action should index tasks by created_at_from')]
    public function testIndexTasksByCreatedAtFrom(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'created_at' => Carbon::now()
                ->minus(days: 1),
        ])->save();

        $createdAtFrom = Carbon::now()
            ->minus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'created_at_from' => $createdAtFrom->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('created_at', '>=', $createdAtFrom)
                ->get(),
            actual: $response,
            message: 'action should index tasks by created_at_from',
        );
    }

    #[TestDox('action should index tasks by created_at_to')]
    public function testIndexTasksByCreatedAtTo(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'created_at' => Carbon::now()
                ->plus(days: 1),
        ])->save();

        $createdAtTo = Carbon::now()
            ->plus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'created_at_to' => $createdAtTo->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('created_at', '<=', $createdAtTo)
                ->get(),
            actual: $response,
            message: 'action should index tasks by created_at_to',
        );
    }

    #[TestDox('action should index tasks by updated_at_from')]
    public function testIndexTasksByUpdatedAtFrom(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'updated_at' => Carbon::now()
                ->minus(days: 1),
        ])->save();

        $updatedAtFrom = Carbon::now()
            ->minus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'updated_at_from' => $updatedAtFrom->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('updated_at', '>=', $updatedAtFrom)
                ->get(),
            actual: $response,
            message: 'action should index tasks by updated_at_from',
        );
    }

    #[TestDox('action should index tasks by updated_at_to')]
    public function testIndexTasksByUpdatedAtTo(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'updated_at' => Carbon::now()
                ->plus(days: 1),
        ])->save();

        $updatedAtTo = Carbon::now()
            ->plus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'updated_at_to' => $updatedAtTo->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('updated_at', '<=', $updatedAtTo)
                ->get(),
            actual: $response,
            message: 'action should index tasks by updated_at_to',
        );
    }

    #[TestDox('action should index tasks by deadline_from')]
    public function testIndexTasksByDeadlineFrom(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'deadline' => Carbon::now()
                ->minus(days: 1),
        ])->save();

        $deadlineFrom = Carbon::now()
            ->minus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'deadline_from' => $deadlineFrom->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('deadline', '>=', $deadlineFrom)
                ->get(),
            actual: $response,
            message: 'action should index tasks by deadline_from',
        );
    }

    #[TestDox('action should index tasks by deadline_to')]
    public function testIndexTasksByDeadlineTo(): void
    {
        $user = User::factory()
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->count(3)
            ->create();

        $tasks->first()->forceFill([
            'deadline' => Carbon::now()
                ->plus(days: 1),
        ])->save();

        $deadlineTo = Carbon::now()
            ->plus(hours: 1);

        $response = $this->action(
            class: IndexTasksAction::class,
            dto: IndexTasksDto::from(
                data: [
                    'user_uuid' => $user->uuid,
                    'deadline_to' => $deadlineTo->toAtomString(),
                ]
            ),
        );

        $this->assertEquals(
            expected: Task::query()
                ->where('user_uuid', $user->uuid)
                ->where('deadline', '<=', $deadlineTo)
                ->get(),
            actual: $response,
            message: 'action should index tasks by deadline_to',
        );
    }

    // #[TestDox('action should index tasks by query_by')]
    // public function testIndexTasksByQueryBy(): void
    // {
    //     $user = User::factory()
    //         ->create();
    //
    //     $tasks = Task::factory()
    //         ->for($user)
    //         ->count(3)
    //         ->create();
    //
    //     $tasks->first()->forceFill([
    //         'deadline' => Carbon::now()
    //             ->plus(days: 1),
    //     ])->save();
    //
    //     $deadlineTo = Carbon::now()
    //         ->plus(hours: 1);
    //
    //     $response = $this->action(
    //         class: IndexTasksAction::class,
    //         dto: IndexTasksDto::from(
    //             data: [
    //                 'user_uuid' => $user->uuid,
    //                 'deadline_to' => $deadlineTo->toAtomString(),
    //             ]
    //         ),
    //     );
    //
    //     $this->assertEquals(
    //         expected: Task::query()
    //             ->where('user_uuid', $user->uuid)
    //             ->where('deadline', '<=', $deadlineTo)
    //             ->get(),
    //         actual: $response,
    //         message: 'action should index tasks by deadline_to',
    //     );
    // }
}
