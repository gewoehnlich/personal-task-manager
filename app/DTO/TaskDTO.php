<?php

namespace App\DTO;

use Illuminate\Http\Request;

class TaskDTO
{
    public int $userId;
    public string $title;
    public string $text;
    public string $taskStatus;
    public int $deadline;

    public function __construct(Request $request)
    {
        if (!is_null($request->input('user_id'))) {
            $this->userId = $request->input('user_id');
        }

        if (!is_null($request->input('title'))) {
            $this->title = $request->input('title');
        }

        if (!is_null($request->input('text'))) {
            $this->text = $request->input('text');
        }

        if (!is_null($request->input('task_status'))) {
            $this->taskStatus = $request->input('task_status');
        }

        if (!is_null($request->input('deadline'))) {
            $this->deadline = $request->input('deadline');
        }
    }
}
