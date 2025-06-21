<?php

namespace App\DTO\API\Tasks;

use Illuminate\Support\Carbon;
use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\CreateTaskRequest;

final class CreateTaskDTO extends TaskDTO
{
    public readonly int $userId;
    public readonly string $title;
    public readonly string $description;
    public readonly Stage $stage;
    public readonly Carbon $deadline;

    public function __construct(CreateTaskRequest $request)
    {
        $this->userId      = $request->user_id;
        $this->title       = $request->title;
        $this->description = $request->description;
        $this->stage       = $request->stage;
        $this->deadline    = $request->deadline;
    }
}
