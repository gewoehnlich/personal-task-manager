<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Enums\DeletedEnum;
use App\Containers\Bills\Enums\OrderByEnum;
use App\Containers\Bills\Enums\OrderByFieldEnum;
use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Containers\Bills\Values\DescriptionValue;
use App\Containers\Bills\Values\MinutesSpentValue;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Values\CreatedAtValue;
use App\Ship\Values\DeletedAtValue;
use App\Ship\Values\UpdatedAtValue;

final readonly class IndexBillsDto extends Dto
{
    public function __construct(
        private readonly User $user,
        private readonly ?Bill $bill = null,
        private readonly ?Task $task = null,
        private readonly ?DescriptionValue $description = null,
        private readonly ?MinutesSpentValue $minutesSpent = null,
        private readonly ?DeletedEnum $deleted = null,
        private readonly ?CreatedAtValue $createdAtFrom = null,
        private readonly ?CreatedAtValue $createdAtTo = null,
        private readonly ?UpdatedAtValue $updatedAtFrom = null,
        private readonly ?UpdatedAtValue $updatedAtTo = null,
        private readonly ?DeletedAtValue $deletedAtFrom = null,
        private readonly ?DeletedAtValue $deletedAtTo = null,
        private readonly ?PerformedAtValue $performedAtFrom = null,
        private readonly ?PerformedAtValue $performedAtTo = null,
        private readonly ?OrderByEnum $orderBy = null,
        private readonly ?OrderByFieldEnum $orderByField = null,
        private readonly ?int $limit = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function billUuid(): ?string
    {
        return $this->bill?->uuid;
    }

    public function taskUuid(): ?string
    {
        return $this->task?->uuid;
    }

    public function description(): ?string
    {
        return $this->description?->value();
    }

    public function minutesSpent(): ?int
    {
        return $this->minutesSpent?->value();
    }

    public function deleted(): ?DeletedEnum
    {
        return $this->deleted;
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

    public function performedAtFrom(): ?string
    {
        return $this->performedAtFrom?->value();
    }

    public function performedAtTo(): ?string
    {
        return $this->performedAtTo?->value();
    }

    public function orderBy(): ?string
    {
        return $this->orderBy?->value;
    }

    public function orderByField(): ?string
    {
        return $this->orderByField?->value;
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
            bill: BillRepository::byNullableUuid(
                uuid: $inputData['uuid'],
                taskUuid: $inputData['task_uuid'],
            ),
            task: TaskRepository::byNullableUuid(
                uuid: $inputData['task_uuid'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            minutesSpent: MinutesSpentValue::fromNullable(
                input: $inputData['minutes_spent'],
            ),
            deleted: DeletedEnum::tryFrom(
                value: $inputData['deleted'],
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
            performedAtFrom: PerformedAtValue::fromNullable(
                value: $inputData['performed_at_from'],
            ),
            performedAtTo: PerformedAtValue::fromNullable(
                value: $inputData['performed_at_to'],
            ),
            orderBy: OrderByEnum::tryFrom(
                value: $inputData['order_by'],
            ),
            orderByField: OrderByFieldEnum::tryFrom(
                value: $inputData['order_by_field'],
            ),
            limit: $inputData['limit'],
        );
    }
}
