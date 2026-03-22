<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Tasks\Enums\DeletedEnum;
use App\Containers\Tasks\Enums\OrderByEnum;
use App\Containers\Tasks\Enums\OrderByFieldEnum;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\StageValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Values\CreatedAtValue;
use App\Ship\Values\DeletedAtValue;
use App\Ship\Values\UpdatedAtValue;

final readonly class IndexTasksDto extends Dto
{
    public function __construct(
        private readonly User $user,
        private readonly ?Task $task = null,
        private readonly ?TitleValue $title = null,
        private readonly ?DescriptionValue $description = null,
        private readonly ?StageValue $stage = null,
        private readonly ?Project $project = null,
        private readonly ?CreatedAtValue $createdAtFrom = null,
        private readonly ?CreatedAtValue $createdAtTo = null,
        private readonly ?UpdatedAtValue $updatedAtFrom = null,
        private readonly ?UpdatedAtValue $updatedAtTo = null,
        private readonly ?DeletedAtValue $deletedAtFrom = null,
        private readonly ?DeletedAtValue $deletedAtTo = null,
        private readonly ?DeadlineValue $deadlineFrom = null,
        private readonly ?DeadlineValue $deadlineTo = null,
        private readonly ?OrderByEnum $orderBy = null,
        private readonly ?OrderByFieldEnum $orderByField = null,
        private readonly ?DeletedEnum $deleted = null,
        private readonly ?int $limit = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function taskUuid(): ?string
    {
        return $this->task?->uuid;
    }

    public function title(): ?string
    {
        return $this->title?->value();
    }

    public function description(): ?string
    {
        return $this->description?->value();
    }

    public function stage(): ?string
    {
        return $this->stage?->value();
    }

    public function projectUuid(): ?string
    {
        return $this->project?->uuid;
    }

    public function createdAtFrom(): ?string
    {
        return $this->createdAtFrom?->value();
    }

    public function createdAtTo(): ?string
    {
        return $this->createdAtTo?->value();
    }

    public function updatedAtFrom(): ?string
    {
        return $this->updatedAtFrom?->value();
    }

    public function updatedAtTo(): ?string
    {
        return $this->updatedAtTo?->value();
    }

    public function deletedAtFrom(): ?string
    {
        return $this->deletedAtFrom?->value();
    }

    public function deletedAtTo(): ?string
    {
        return $this->deletedAtTo?->value();
    }

    public function deadlineFrom(): ?string
    {
        return $this->deadlineFrom?->value();
    }

    public function deadlineTo(): ?string
    {
        return $this->deadlineTo?->value();
    }

    public function orderBy(): ?string
    {
        return $this->orderBy?->value;
    }

    public function orderByField(): ?string
    {
        return $this->orderByField?->value;
    }

    public function deleted(): ?DeletedEnum
    {
        return $this->deleted;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            user: $inputData['user'],
            task: TaskRepository::byNullableUuid(
                uuid: $inputData['uuid'],
            ),
            title: TitleValue::fromNullable(
                input: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            stage: StageValue::fromNullable(
                string: $inputData['stage'],
            ),
            project: ProjectRepository::byNullableUuid(
                uuid: $inputData['project_uuid'],
            ),
            createdAtFrom: CreatedAtValue::fromNullable(
                value: $inputData['created_at_from'],
            ),
            createdAtTo: CreatedAtValue::fromNullable(
                value: $inputData['created_at_to'],
            ),
            updatedAtFrom: UpdatedAtValue::fromNullable(
                value: $inputData['updated_at_from'],
            ),
            updatedAtTo: UpdatedAtValue::fromNullable(
                value: $inputData['updated_at_to'],
            ),
            deletedAtFrom: DeletedAtValue::fromNullable(
                value: $inputData['deleted_at_from'],
            ),
            deletedAtTo: DeletedAtValue::fromNullable(
                value: $inputData['deleted_at_to'],
            ),
            deadlineFrom: DeadlineValue::fromNullable(
                value: $inputData['deadline_from'],
            ),
            deadlineTo: DeadlineValue::fromNullable(
                value: $inputData['deadline_to'],
            ),
            orderBy: OrderByEnum::tryFrom(
                value: $inputData['order_by'],
            ),
            orderByField: OrderByFieldEnum::tryFrom(
                value: $inputData['order_by_field'],
            ),
            deleted: DeletedEnum::tryFrom(
                value: $inputData['deleted'],
            ),
            limit: $inputData['limit'],
        );
    }
}
