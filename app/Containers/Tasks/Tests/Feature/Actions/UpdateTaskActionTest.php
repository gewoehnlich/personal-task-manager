<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Dto\UpdateTaskDto;
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
#[CoversClass(UpdateTaskAction::class)]
#[Medium]
#[UsesClass(UpdateTaskDto::class)]
final class UpdateTaskActionTest extends TestCase
{
    #[TestDox('update task action should create a task with all parameters filled in')]
    public function testActionWithAllParametersFilledIn(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $task = Task::factory()
            ->for($user)
            ->for($project)
            ->create();

        $title = 'title';

        $description = 'description';

        $stage = Stage::PENDING;

        $deadline = Carbon::now()
            ->plus(days: 1);

        $data = [
            'uuid'         => $task->uuid,
            'user_uuid'    => $user->uuid,
            'title'        => $title,
            'description'  => $description,
            'stage'        => $stage->value,
            'deadline'     => $deadline->toAtomString(),
            'project_uuid' => $project->uuid,
        ];

        $this->assertNotSame(
            expected: $task->toArray(),
            actual: $data,
            message: 'these two arrays should not be the same',
        );

        $dto = UpdateTaskDto::from(
            data: $data,
        );

        $response = $this->action(
            class: UpdateTaskAction::class,
            dto: $dto,
        );

        $this->assertDatabaseHas(
            table: 'tasks',
            data: $data,
        );
    }

    #[TestDox('update task action should create a task with nullable parameters being null')]
    public function testActionWithNullableParametersBeingNull(): void
    {
        $user = User::factory()
            ->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $title = 'title';

        $stage = Stage::PENDING;

        $data = [
            'uuid'         => $task->uuid,
            'user_uuid'    => $user->uuid,
            'title'        => $title,
            'description'  => null,
            'stage'        => $stage->value,
            'deadline'     => null,
            'project_uuid' => null,
        ];

        $this->assertNotSame(
            expected: $task->toArray(),
            actual: $data,
            message: 'these two arrays should not be the same',
        );

        $dto = UpdateTaskDto::from(
            data: $data,
        );

        $response = $this->action(
            class: UpdateTaskAction::class,
            dto: $dto,
        );

        $this->assertDatabaseHas(
            table: 'tasks',
            data: $data,
        );
    }
}
