<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(UpdateTaskDto::class)]
#[Small]
final class UpdateTaskDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithExistingTaskUuid(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $stage = StageEnum::PENDING;

        $title = 'title';

        $description = 'description';

        $deadline = (new DeadlineValue(
            carbon: Carbon::now(),
        ))
            ->value();

        $project = $this->project(
            user: $user,
        );

        $dto = UpdateTaskDto::from([
            'uuid'         => $task->uuid,
            'user'         => $user,
            'title'        => $title,
            'stage'        => $stage->value,
            'description'  => $description,
            'deadline'     => $deadline,
            'project_uuid' => $project->uuid,
        ]);

        $this->assertSame(
            expected: $task->uuid,
            actual: $dto->task->uuid,
        );

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title?->value(),
        );

        $this->assertSame(
            expected: $stage->value,
            actual: $dto->stage?->value(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description?->value(),
        );

        $this->assertSame(
            expected: $deadline,
            actual: $dto->deadline?->value(),
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->project?->uuid,
        );
    }

    public function testFromMethodShouldThrowAnExceptionWithInvalidTaskUuid(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: TaskWithThisUuidDoesNotExistException::class,
        );

        UpdateTaskDto::from([
            'uuid'        => $user->uuid, // not actual task uuid
            'user'        => $user,
            'title'       => 'title',
            'description' => 'description',
        ]);
    }
}
