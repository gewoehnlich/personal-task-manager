<?php

namespace App\Containers\Tasks\Transfers\Transporters;

use App\DTO\API\APIDTO;
use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\TaskRequest;
use Illuminate\Support\Carbon;

/**
 * @property-read int    $id
 * @property-read int    $userId
 * @property-read string $title
 * @property-read string $description
 * @property-read Stage  $stage
 * @property-read Carbon $deadline
 * @property-read int    $parentId
 * @property-read int    $projectId
 * @property-read Carbon $createdAtFrom
 * @property-read Carbon $createdAtTo
 * @property-read Carbon $updatedAtFrom
 * @property-read Carbon $updatedAtTo
 * @property-read Carbon $deadlineFrom
 * @property-read Carbon $deadlineTo
 * @property-read string $orderBy
 * @property-read string $orderByField
 * @property-read int    $limit
 */
abstract readonly class TaskDTO // extends APIDTO
{
    final public static function fromRequest(
        TaskRequest $request,
        string $class
    ): TaskDTO {
        $dto = new $class($request);

        return $dto;
    }

    protected static function stage(string | null $stage): Stage | null
    {
        if (is_null($stage)) {
            return null;
        }

        return Stage::tryFrom($stage);
    }

    protected static function date(string | null $date): Carbon | null
    {
        if (is_null($date)) {
            return null;
        }

        return Carbon::parse($date);
    }
}
