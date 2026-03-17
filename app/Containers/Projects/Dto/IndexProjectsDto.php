<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Enums\OrderByEnum;
use App\Containers\Projects\Enums\OrderByFieldEnum;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Projects\Values\CreatedAtValue;
use App\Containers\Projects\Values\DeletedAtValue;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Projects\Values\UpdatedAtValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class IndexProjectsDto extends Dto
{
    public function __construct(
        public readonly User $user,
        public readonly ?Project $project = null,
        public readonly ?TitleValue $title = null,
        public readonly ?DescriptionValue $description = null,
        public readonly ?DeletedEnum $deleted = null,
        public readonly ?CreatedAtValue $createdAtFrom = null,
        public readonly ?CreatedAtValue $createdAtTo = null,
        public readonly ?UpdatedAtValue $updatedAtFrom = null,
        public readonly ?UpdatedAtValue $updatedAtTo = null,
        public readonly ?DeletedAtValue $deletedAtFrom = null,
        public readonly ?DeletedAtValue $deletedAtTo = null,
        public readonly ?OrderByEnum $orderBy = null,
        public readonly ?OrderByFieldEnum $orderByField = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
    }

    public function projectUuid(): ?string
    {
        return $this->project?->uuid;
    }

    public function title(): ?string
    {
        return $this->title?->value();
    }

    public function description(): ?string
    {
        return $this->description?->value();
    }

    public function deleted(): ?string
    {
        return $this->deleted?->value;
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

    public function orderBy(): ?string
    {
        return $this->orderBy?->value;
    }

    public function orderByField(): ?string
    {
        return $this->orderByField?->value;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            user: $inputData['user'],
            project: ProjectRepository::byNullableUuid(
                uuid: $inputData['uuid'],
            ),
            title: TitleValue::fromNullable(
                input: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
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
            orderBy: OrderByEnum::tryFrom(
                value: $inputData['order_by'],
            ),
            orderByField: OrderByFieldEnum::tryFrom(
                value: $inputData['order_by_field'],
            ),
        );
    }
}
