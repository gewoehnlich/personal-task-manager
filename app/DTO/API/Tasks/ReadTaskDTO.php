<?php

namespace App\DTO\API\Tasks;

use App\Http\Requests\API\Tasks\ReadTaskRequest;
use Illuminate\Support\Carbon;

final class ReadTaskDTO extends TaskDTO
{
    public readonly int $userId;
    public readonly int | null $id;
    public readonly int | null $parentId;
    public readonly int | null $projectId;
    public readonly Carbon | null $createdAtFrom;
    public readonly Carbon | null $createdAtTo;
    public readonly Carbon | null $updatedAtFrom;
    public readonly Carbon | null $updatedAtTo;
    public readonly Carbon | null $deadlineFrom;
    public readonly Carbon | null $deadlineTo;
    public readonly string | null $orderBy;
    public readonly string | null $orderByField;
    public readonly int | null $limit;

    public function __construct(ReadTaskRequest $request)
    {
        $this->userId            = $request->user_id;
        $this->id                = $request->id;
        $this->parentId          = $request->parent_id;
        $this->projectId         = $request->project_id;
        $this->createdAtFrom     = $request->created_at_from;
        $this->createdAtTo       = $request->created_at_to;
        $this->updatedAtFrom     = $request->updated_at_from;
        $this->updatedAtTo       = $request->updated_at_to;
        $this->deadlineFrom      = $request->deadline_from;
        $this->deadlineTo        = $request->deadlineTo;
        $this->orderBy           = $request->order_by;
        $this->limit             = $request->limit;
    }
}
