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
        public readonly User $user,
        public readonly ?Bill $bill = null,
        public readonly ?Task $task = null,
        public readonly ?DescriptionValue $description = null,
        public readonly ?MinutesSpentValue $minutesSpent = null,
        public readonly ?DeletedEnum $deleted = null,
        public readonly ?CreatedAtValue $createdAtFrom = null,
        public readonly ?CreatedAtValue $createdAtTo = null,
        public readonly ?UpdatedAtValue $updatedAtFrom = null,
        public readonly ?UpdatedAtValue $updatedAtTo = null,
        public readonly ?DeletedAtValue $deletedAtFrom = null,
        public readonly ?DeletedAtValue $deletedAtTo = null,
        public readonly ?PerformedAtValue $performedAtFrom = null,
        public readonly ?PerformedAtValue $performedAtTo = null,
        public readonly ?OrderByEnum $orderBy = null,
        public readonly ?OrderByFieldEnum $orderByField = null,
        public readonly ?int $limit = null,
    ) {
        //
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
