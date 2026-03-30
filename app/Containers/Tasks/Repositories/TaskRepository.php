<?php

namespace App\Containers\Tasks\Repositories;

use App\Containers\Tasks\Exceptions\TaskDoesNotBelongToAuthenticatedUserException;
use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Repositories\Repository;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use Illuminate\Support\Facades\Auth;

final readonly class TaskRepository extends Repository
{
    public static function byUuid(
        ?string $uuid,
    ): Task {
        if ($uuid === null) {
            throw new RequiredValueIsNotPresentException(
                entity: Task::class,
            );
        }

        /** @var Task|null $task */
        $task = Task::query()
            ->withTrashed()
            ->with('user')
            ->with('project')
            ->where('uuid', $uuid)
            ->first();

        if ($task === null) {
            throw new TaskWithThisUuidDoesNotExistException(
                uuid: $uuid,
            );
        }

        if ($task->user->uuid !== Auth::user()->uuid) {
            throw new TaskDoesNotBelongToAuthenticatedUserException(
                uuid: $uuid,
            );
        }

        return $task;
    }

    public static function byNullableUuid(
        ?string $uuid,
    ): ?Task {
        if ($uuid === null) {
            return null;
        }

        return self::byUuid(
            uuid: $uuid,
        );
    }
}
