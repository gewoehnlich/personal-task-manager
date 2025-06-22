<?php

namespace App\DTO\API\Tasks;

use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\UpdateTaskRequest;
use Illuminate\Support\Carbon;

final class UpdateTaskDTO extends TaskDTO
{
    final public readonly int $id;
    final public readonly int $userId;
    final public readonly string $title;
    final public readonly string $description;
    final public readonly Stage $stage;
    final public readonly Carbon $deadline;
    final public readonly int | null $parentId;
    final public readonly int | null $projectId;

    public function __construct(UpdateTaskRequest $request)
    {
        $this->id          = $request->id;
        $this->userId      = $request->user_id;
        $this->title       = $request->title;
        $this->description = $request->description;
        $this->stage       = self::stage($request->stage);
        $this->deadline    = self::date($request->deadline);
        $this->parentId    = $request->parent_id;
        $this->projectId   = $request->project_id;
    }
}
