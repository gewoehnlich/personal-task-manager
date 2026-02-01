<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class UpdateTaskDto extends Dto
{
    public function __construct(
        public readonly TaskUuidValue $uuid,
        public readonly UserUuidValue $userUuid,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
        public readonly Stage $stage,
        public readonly ?DeadlineValue $deadline = null,
        public readonly ?ProjectUuidValue $projectUuid = null,
    ) {
        //
    }

    public function uuid(): string
    {
        return $this->uuid->uuid;
    }

    public function userUuid(): string
    {
        return $this->userUuid->uuid;
    }

    public function title(): string
    {
        return $this->title->string;
    }

    public function description(): ?string
    {
        return $this->description?->string;
    }

    public function stage(): string
    {
        return $this->stage->value;
    }

    public function deadline(): ?string
    {
        return $this->deadline?->carbon->toAtomString();
    }

    public function projectUuid(): ?string
    {
        return $this->projectUuid?->uuid;
    }

    public function toArray(): array
    {
        return [
            'uuid'         => $this->uuid(),
            'user_uuid'    => $this->userUuid(),
            'title'        => $this->title(),
            'description'  => $this->description(),
            'stage'        => $this->stage(),
            'deadline'     => $this->deadline(),
            'project_uuid' => $this->projectUuid(),
        ];
    }

    public static function from(
        array $data,
    ): self {
        return new self(
            uuid: new TaskUuidValue(
                uuid: $data['uuid'],
            ),
            userUuid: new UserUuidValue(
                uuid: $data['user_uuid'],
            ),
            title: new TitleValue(
                string: $data['title'],
            ),
            description: $data['description'] === null
                ? null
                : new DescriptionValue(
                    string: $data['description'],
                ),
            stage: Stage::from(
                value: $data['stage'],
            ),
            deadline: $data['deadline'] === null
                ? null
                : DeadlineValue::from(
                    value: $data['deadline'],
                ),
            projectUuid: $data['project_uuid'] === null
                ? null
                : new ProjectUuidValue(
                    uuid: $data['project_uuid'],
                ),
        );
    }
}
