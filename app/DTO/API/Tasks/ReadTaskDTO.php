<?php

namespace App\DTO\API\Tasks;

use App\Http\Requests\API\Tasks\ReadTaskRequest;
use Illuminate\Support\Carbon;

final class ReadTaskDTO extends TaskDTO
{
    public readonly int $userId;
    public readonly Carbon $start;
    public readonly Carbon $end;

    public function __construct(ReadTaskRequest $request)
    {
        $this->userId = $request->user_id;
        $this->start = $request->start;
        $this->end = $request->end;
    }
}
