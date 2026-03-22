<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(UpdateTaskAction::class)]
#[Medium]
#[UsesClass(UpdateTaskDto::class)]
final class UpdateTaskActionTest extends TestCase
{
    public function testActionUpdatesTheTask(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $title = 'title';

        $stage = StageEnum::PENDING;

        $description = 'description';

        $deadline = new DeadlineValue(
            carbon: Carbon::now(),
        )
            ->value();

        $project = $this->project(
            user: $user,
        );

        $this->action(
            class: UpdateTaskAction::class,
            dto: UpdateTaskDto::from([
                'uuid'         => $task->uuid,
                'user'         => $user,
                'title'        => $title,
                'stage'        => $stage->value,
                'description'  => $description,
                'deadline'     => $deadline,
                'project_uuid' => $project->uuid,
            ]),
        );

        $updatedTask = Task::where('uuid', $task->uuid)
            ->first();

        $this->assertEquals(
            expected: $title,
            actual: $updatedTask->title,
        );

        $this->assertEquals(
            expected: $stage->value,
            actual: $updatedTask->stage,
        );

        $this->assertEquals(
            expected: $description,
            actual: $updatedTask->description,
        );

        $this->assertEquals(
            expected: $deadline,
            actual: $updatedTask->deadline->format(DeadlineValue::format()),
        );

        $this->assertEquals(
            expected: $project->uuid,
            actual: $updatedTask->project_uuid,
            message: 'updatedTask project_uuid should be the updated one',
        );
    }
}
