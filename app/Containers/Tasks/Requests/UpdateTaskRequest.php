<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Ship\Abstracts\Requests\Request;

final class UpdateTaskRequest extends Request
{
    public function dto(): string
    {
        return UpdateTaskDto::class;
    }

    protected function extract(): array
    {
        return [
            'user'         => $this->user(),
            'uuid'         => $this->route('uuid', default: null),
            'title'        => $this->input('title', default: null),
            'stage'        => $this->input('stage', default: null),
            'description'  => $this->input('description', default: null),
            'deadline'     => $this->input('deadline', default: null),
            'project_uuid' => $this->input('project_uuid', default: null),
        ];
    }
}
