<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\StageValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class UpdateTaskDto extends Dto
{
    public function __construct(
        private readonly Task $task,
        private readonly User $user,
        private readonly TitleValue $title,
        private readonly StageValue $stage,
        private readonly ?DescriptionValue $description = null,
        private readonly ?DeadlineValue $deadline = null,
        private readonly ?Project $project = null,
    ) {
        //
    }

    public function task(): Task
    {
        return $this->task;
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function title(): string
    {
        return $this->title->string;
    }

    public function stage(): string
    {
        return $this->stage->value();
    }

    public function description(): ?string
    {
        return $this->description?->string;
    }

    public function deadline(): ?string
    {
        return $this->deadline?->carbon->toAtomString();
    }

    public function projectUuid(): ?string
    {
        return $this->project?->uuid;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            task: TaskRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
            user: $inputData['user'],
            title: TitleValue::from(
                string: $inputData['title'],
            ),
            stage: StageValue::from(
                string: $inputData['stage'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            deadline: DeadlineValue::fromNullable(
                value: $inputData['deadline'],
            ),
            project: ProjectRepository::byNullableUuid(
                uuid: $inputData['project_uuid'],
            ),
        );
    }
}
