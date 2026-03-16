<?php

namespace App\Containers\Projects\Repositories;

use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

final readonly class ProjectRepository extends Repository
{
    public static function byUuid(
        string $uuid,
    ): Project {
        /** @var Project|null $project */
        $project = Project::query()
            ->withTrashed()
            ->with('user')
            ->where('uuid', $uuid)
            ->first();

        if ($project === null) {
            throw new ProjectWithThisUuidDoesNotExistException(
                uuid: $uuid,
            );
        }

        if ($project->user->uuid !== Auth::user()->uuid) {
            throw new ProjectDoesNotBelongToAuthenticatedUserException(
                uuid: $uuid,
            );
        }

        return $project;
    }

    public static function byNullableUuid(
        ?string $uuid,
    ): ?Project {
        if ($uuid === null) {
            return null;
        }

        return self::byUuid(
            uuid: $uuid,
        );
    }
}
