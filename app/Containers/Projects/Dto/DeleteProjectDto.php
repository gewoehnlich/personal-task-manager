<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteProjectDto extends Dto
{
    public function __construct(
        private readonly Project $project,
        private readonly bool $force,
    ) {
        //
    }

    public function project(): Project
    {
        return $this->project;
    }

    public function force(): bool
    {
        return $this->force;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            project: ProjectRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
            force: $inputData['force'],
        );
    }
}
