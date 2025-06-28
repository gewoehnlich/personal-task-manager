<?php

namespace App\DTO\API\Tasks;

use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\ReadTaskRequest;
use Illuminate\Support\Carbon;

final class ReadTaskTransporter extends TaskDTO
{
    final public readonly int $userId;
    final public readonly int | null $id;
    final public readonly Stage | null $stage;
    final public readonly int | null $parentId;
    final public readonly int | null $projectId;
    final public readonly Carbon | null $createdAtFrom;
    final public readonly Carbon | null $createdAtTo;
    final public readonly Carbon | null $updatedAtFrom;
    final public readonly Carbon | null $updatedAtTo;
    final public readonly Carbon | null $deadlineFrom;
    final public readonly Carbon | null $deadlineTo;
    final public readonly string | null $orderBy;
    final public readonly string | null $orderByField;
    final public readonly int | null $limit;

    public function __construct(ReadTaskRequest $request)
    {
        $this->userId            = $request->user_id;
        $this->id                = $request->id;
        $this->stage             = self::stage($request->stage);
        $this->parentId          = $request->parent_id;
        $this->projectId         = $request->project_id;
        $this->createdAtFrom     = self::date($request->created_at_from);
        $this->createdAtTo       = self::date($request->created_at_to);
        $this->updatedAtFrom     = self::date($request->updated_at_from);
        $this->updatedAtTo       = self::date($request->updated_at_to);
        $this->deadlineFrom      = self::date($request->deadline_from);
        $this->deadlineTo        = self::date($request->deadlineTo);
        $this->orderBy           = $request->order_by;
        $this->orderByField      = $request->order_by_field;
        $this->limit             = $request->limit;
    }
}
