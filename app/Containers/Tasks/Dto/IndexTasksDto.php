<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Tasks\Enums\OrderBy;
use App\Containers\Tasks\Enums\OrderByField;
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
        public readonly ?OrderBy $orderBy = null,
        public readonly ?OrderByField $orderByField = null,
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
        return new self(
            userUuid: new UserUuidValue(
                uuid: $data['user_uuid'],
            ),
            uuid: array_key_exists('uuid', $data)
                ? new TaskUuidValue(uuid: $data['uuid'])
                : null,
            stage: array_key_exists('stage', $data)
                ? Stage::from(value: $data['stage'])
                : null,
            projectUuid: array_key_exists('project_uuid', $data)
                ? new ProjectUuidValue(uuid: $data['project_uuid'])
                : null,
            createdAtFrom: array_key_exists('created_at_from', $data)
                ? CreatedAtValue::from(value: $data['created_at_from'])
                : null,
            createdAtTo: array_key_exists('created_at_to', $data)
                ? CreatedAtValue::from(value: $data['created_at_to'])
                : null,
            updatedAtFrom: array_key_exists('updated_at_from', $data)
                ? UpdatedAtValue::from(value: $data['updated_at_from'])
                : null,
            updatedAtTo: array_key_exists('updated_at_to', $data)
                ? UpdatedAtValue::from(value: $data['updated_at_to'])
                : null,
            deadlineFrom: array_key_exists('deadline_from', $data)
                ? DeadlineValue::from(value: $data['deadline_from'])
                : null,
            deadlineTo: array_key_exists('deadline_to', $data)
                ? DeadlineValue::from(value: $data['deadline_to'])
                : null,
            orderBy: array_key_exists('order_by', $data)
                ? OrderBy::from(value: $data['order_by'])
                : null,
            orderByField: array_key_exists('order_by_field', $data)
                ? OrderByField::from(value: $data['order_by_field'])
                : null,
            limit: $data['limit'] ?? null,
            withDeleted: $data['with_deleted'] ?? null,
        );
    }
}
