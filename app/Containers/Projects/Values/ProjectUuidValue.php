<?php

namespace App\Containers\Projects\Values;

use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Ship\Values\UuidValue;

final readonly class ProjectUuidValue extends UuidValue
{
    protected function validate(): void
    {
        parent::validate();

        $this->doesProjectWithThisUuidExist();
    }

    private function doesProjectWithThisUuidExist(): void
    {
        $project = Project::query()
            ->where('uuid', $this->uuid)
            ->first();

        if ($project === null) {
            throw new ProjectWithThisUuidDoesNotExistException(
                uuid: $this->uuid,
            );
        }
    }
}
