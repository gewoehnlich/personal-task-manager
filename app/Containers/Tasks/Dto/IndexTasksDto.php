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
        public readonly User $user,
        public readonly ?Task $task = null,
        public readonly ?TitleValue $title = null,
        public readonly ?DescriptionValue $description = null,
        public readonly ?StageValue $stage = null,
        public readonly ?Project $project = null,
        public readonly ?CreatedAtValue $createdAtFrom = null,
        public readonly ?CreatedAtValue $createdAtTo = null,
        public readonly ?UpdatedAtValue $updatedAtFrom = null,
        public readonly ?UpdatedAtValue $updatedAtTo = null,
        public readonly ?DeletedAtValue $deletedAtFrom = null,
        public readonly ?DeletedAtValue $deletedAtTo = null,
        public readonly ?DeadlineValue $deadlineFrom = null,
        public readonly ?DeadlineValue $deadlineTo = null,
        public readonly ?OrderByEnum $orderBy = null,
        public readonly ?OrderByFieldEnum $orderByField = null,
        public readonly ?DeletedEnum $deleted = null,
        public readonly ?int $limit = null,
    ) {
        //
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
