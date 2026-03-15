<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class RestoreProjectDto extends Dto
{
    public function __construct(
        public readonly Project $project,
    ) {
        //
    }

    public function projectUuid(): string
    {
        return $this->project->uuid;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->projectUuid(),
        ];
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            project: ProjectRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
        );
    }
}
