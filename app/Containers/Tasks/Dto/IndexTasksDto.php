<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\CreatedAtValue;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Tasks\Values\UpdatedAtValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class IndexTasksDto extends Dto
{
    public function __construct(
        public readonly UserUuidValue $userUuid,
        public readonly ?TaskUuidValue $uuid = null,
        public readonly ?Stage $stage = null,
        public readonly ?ProjectUuidValue $projectUuid = null,
        public readonly ?CreatedAtValue $createdAtFrom = null,
        public readonly ?CreatedAtValue $createdAtTo = null,
        public readonly ?UpdatedAtValue $updatedAtFrom = null,
        public readonly ?UpdatedAtValue $updatedAtTo = null,
        public readonly ?DeadlineValue $deadlineFrom = null,
        public readonly ?DeadlineValue $deadlineTo = null,
        public readonly ?string $orderBy = null,
        public readonly ?string $orderByField = null,
        public readonly ?int $limit = null,
        public readonly ?bool $withDeleted = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function uuid(): ?string
    {
        return $this->uuid?->uuid;
    }

    public function stage(): ?string
    {
        return $this->stage?->value;
    }

    public function projectUuid(): ?string
    {
        return $this->projectUuid?->uuid;
    }

    public function createdAtFrom(): ?string
    {
        return $this->createdAtFrom?->carbon->toAtomString();
    }

    public function createdAtTo(): ?string
    {
        return $this->createdAtTo?->carbon->toAtomString();
    }

    public function updatedAtFrom(): ?string
    {
        return $this->updatedAtFrom?->carbon->toAtomString();
    }

    public function updatedAtTo(): ?string
    {
        return $this->updatedAtTo?->carbon->toAtomString();
    }

    public function deadlineFrom(): ?string
    {
        return $this->deadlineFrom?->carbon->toAtomString();
    }

    public function deadlineTo(): ?string
    {
        return $this->deadlineTo?->carbon->toAtomString();
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function orderByField(): ?string
    {
        return $this->orderByField;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function withDeleted(): ?bool
    {
        return $this->withDeleted;
    }

    public function toArray(): array
    {
        return [
            'user_uuid'       => $this->userUuid(),
            'uuid'            => $this->uuid(),
            'stage'           => $this->stage(),
            'project_uuid'    => $this->projectUuid(),
            'created_at_from' => $this->createdAtFrom(),
            'created_at_to'   => $this->createdAtTo(),
            'updated_at_from' => $this->updatedAtFrom(),
            'updated_at_to'   => $this->updatedAtTo(),
            'deadline_from'   => $this->deadlineFrom(),
            'deadline_to'     => $this->deadlineTo(),
            'order_by'        => $this->orderBy(),
            'order_by_field'  => $this->orderByField(),
            'limit'           => $this->limit(),
            'with_deleted'    => $this->withDeleted(),
        ];
    }

    public static function from(
        array $data,
    ): self {
        $data = array_merge([
            'uuid'            => null,
            'stage'           => null,
            'project_uuid'    => null,
            'created_at_from' => null,
            'created_at_to'   => null,
            'updated_at_from' => null,
            'updated_at_to'   => null,
            'deadline_from'   => null,
            'deadline_to'     => null,
            'order_by'        => null,
            'order_by_field'  => null,
            'limit'           => null,
            'with_deleted'    => null,
        ], $data);

        return new self(
            userUuid: new UserUuidValue(
                uuid: $data['user_uuid'],
            ),
            uuid: $data['uuid'] === null
                ? null
                : new TaskUuidValue(
                    uuid: $data['uuid'],
                ),
            stage: $data['stage'] === null
                ? null
                : Stage::from(
                    value: $data['stage'],
                ),
            projectUuid: $data['project_uuid'] === null
                ? null
                : new ProjectUuidValue(
                    uuid: $data['project_uuid'],
                ),
            createdAtFrom: $data['created_at_from'] === null
                ? null
                : CreatedAtValue::from(
                    value: $data['created_at_from'],
                ),
            createdAtTo: $data['created_at_to'] === null
                ? null
                : CreatedAtValue::from(
                    value: $data['created_at_to'],
                ),
            updatedAtFrom: $data['updated_at_from'] === null
                ? null
                : UpdatedAtValue::from(
                    value: $data['updated_at_from'],
                ),
            updatedAtTo: $data['updated_at_to'] === null
                ? null
                : UpdatedAtValue::from(
                    value: $data['updated_at_to'],
                ),
            deadlineFrom: $data['deadline_from'] === null
                ? null
                : DeadlineValue::from(
                    value: $data['deadline_from'],
                ),
            deadlineTo: $data['deadline_to'] === null
                ? null
                : DeadlineValue::from(
                    value: $data['deadline_to'],
                ),
            orderBy: $data['order_by'],
            orderByField: $data['order_by_field'],
            limit: $data['limit'],
            withDeleted: $data['with_deleted'],
        );
    }
}
