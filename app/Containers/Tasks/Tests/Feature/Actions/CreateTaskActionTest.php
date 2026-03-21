<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\StageValue;
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
#[CoversClass(CreateTaskAction::class)]
#[Medium]
#[UsesClass(CreateTaskDto::class)]
final class CreateTaskActionTest extends TestCase
{
    public function testActionCreatesTask(): void
    {
        $user = $this->user();

        $title = 'title';

        $stage = new StageValue(
            stage: Stage::PENDING,
        );

        $description = 'description';

        $deadline = new DeadlineValue(
            carbon: Carbon::now()
                ->addDay(),
        );

        $project = Project::factory()
            ->for($user)
            ->create();

        $task = $this->action(
            class: CreateTaskAction::class,
            dto: CreateTaskDto::from([
                'user' => $user,
                'title' => $title,
                'stage' => $stage->value(),
                'description' => $description,
                'deadline' => $deadline->value(),
                'project_uuid' => $project->uuid,
            ]),
        );

        $this->assertDatabaseHas(
            table: 'tasks',
            data: [
                'uuid'         => $task->uuid,
                'user_uuid'    => $user->uuid,
                'title'        => $title,
                'description'  => $description,
                'stage'        => $stage->value(),
                'deadline'     => $deadline->value(),
                'project_uuid' => $project->uuid,
            ],
        );
    }
}
