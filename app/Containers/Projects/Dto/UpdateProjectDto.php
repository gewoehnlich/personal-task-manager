<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class UpdateProjectDto extends Dto
{
    public function __construct(
        public readonly Project $project,
        public readonly User $user,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
    ) {
        //
    }

    public function projectUuid(): string
    {
        return $this->project->uuid;
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

    public static function from(
        array $inputData,
    ): self {
        return new self(
            project: ProjectRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
            user: $inputData['user'],
            title: TitleValue::from(
                string: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
        );
    }
}
