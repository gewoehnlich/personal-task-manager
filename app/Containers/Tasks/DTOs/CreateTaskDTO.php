<?php

namespace App\Containers\Tasks\DTOs;

use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\CreateTaskRequest;
use App\Ship\Tasks\Transfers\Transporters\TaskDTO;
use Illuminate\Support\Carbon;

final readonly class CreateTaskDTO extends TaskDTO
{
    final public readonly int $userId;
    final public readonly string $title;
    final public readonly string $description;
    final public readonly Stage $stage;
    final public readonly Carbon $deadline;
    final public readonly int | null $parentId;
    final public readonly int | null $projectId;

    public function __construct(CreateTaskRequest $request)
    {
        $this->userId      = $request->user_id;
        $this->title       = $request->title;
        $this->description = $request->description;
        $this->stage       = self::stage($request->stage);
        $this->deadline    = self::date($request->deadline);
        $this->parentId    = $request->parent_id;
        $this->projectId   = $request->project_id;
    }
}
