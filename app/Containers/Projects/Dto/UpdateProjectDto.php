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
        public readonly Project $project,
        public readonly TitleValue $title,
        public readonly ?DescriptionValue $description = null,
    ) {
        //
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
