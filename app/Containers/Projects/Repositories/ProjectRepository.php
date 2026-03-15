<?php

namespace App\Containers\Projects\Repositories;

use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Repositories\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

final readonly class ProjectRepository extends Repository
{
    public static function byUuid(
        string $uuid,
    ): Project {
        /** @var Project | null $project */
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

    public static function byUser(
        User $user,
    ): Collection {
        return Project::query()
            ->with('user')
            ->where('user_uuid', $user->uuid)
            ->get();
    }
}
