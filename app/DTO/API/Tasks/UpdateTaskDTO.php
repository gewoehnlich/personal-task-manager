<?php

namespace App\DTO\API\Tasks;

use Illuminate\Support\Carbon;
use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\UpdateTaskRequest;

final class UpdateTaskDTO extends TaskDTO
{
    public readonly int $id;
    public readonly int $userId;
    public readonly string $title;
    public readonly string $description;
    public readonly Stage $stage;
    public readonly Carbon $deadline;

    public function __construct(UpdateTaskRequest $request)
    {
        $this->id          = $request->id;
        $this->userId      = $request->user_id;
        $this->title       = $request->title;
        $this->description = $request->description;
        $this->stage       = $request->stage;
        $this->deadline    = $request->deadline;
    }
}
