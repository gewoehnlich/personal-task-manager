<?php

namespace App\Containers\Projects\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteProjectDto extends Dto
{
    public function __construct(
        public readonly Project $project,
        public readonly User $user,
        public readonly bool $force,
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
            user: $inputData['user'],
            force: $inputData['force'],
        );
    }
}
