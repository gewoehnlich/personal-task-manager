<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class UpdateProjectDto extends Dto
{
    public function __construct(
        private readonly Project $project,
        private readonly TitleValue $title,
        private readonly ?DescriptionValue $description = null,
    ) {
        //
    }

    public function project(): Project
    {
        return $this->project;
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
            title: TitleValue::from(
                string: $inputData['title'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
        );
    }
}
