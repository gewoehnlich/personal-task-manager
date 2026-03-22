<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\StageValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class CreateTaskDto extends Dto
{
    public function __construct(
        private readonly User $user,
        private readonly TitleValue $title,
        private readonly StageValue $stage,
        private readonly ?DescriptionValue $description = null,
        private readonly ?DeadlineValue $deadline = null,
        private readonly ?Project $project = null,
    ) {
        //
    }

    public function userUuid(): string
    {
        return $this->user->uuid;
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
        return $this->stage->value();
    }

    public function deadline(): ?string
    {
        return $this->deadline?->value();
    }

    public function projectUuid(): ?string
    {
        return $this->project?->uuid;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            user: $inputData['user'],
            title: TitleValue::from(
                string: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            stage: StageValue::from(
                string: $inputData['stage'],
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
