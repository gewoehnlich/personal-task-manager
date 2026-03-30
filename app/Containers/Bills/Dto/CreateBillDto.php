<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Values\DescriptionValue;
use App\Containers\Bills\Values\MinutesSpentValue;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class CreateBillDto extends Dto
{
    public function __construct(
        private readonly Task $task,
        private readonly ?DescriptionValue $description = null,
        private readonly ?MinutesSpentValue $minutesSpent = null,
        private readonly ?PerformedAtValue $performedAt = null,
    ) {
        //
    }

    public function taskUuid(): string
    {
        return $this->task->uuid;
    }

    public function description(): ?string
    {
        return $this->description?->value();
    }

    public function minutesSpent(): ?int
    {
        return $this->minutesSpent?->value();
    }

    public function performedAt(): ?string
    {
        return $this->performedAt?->value();
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            task: TaskRepository::byUuid(
                uuid: $inputData['task_uuid'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            minutesSpent: MinutesSpentValue::fromNullable(
                input: $inputData['minutes_spent'],
            ),
            performedAt: PerformedAtValue::fromNullable(
                value: $inputData['performed_at'],
            ),
        );
    }
}
