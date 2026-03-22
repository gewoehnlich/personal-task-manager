<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Ship\Abstracts\Requests\Request;

final class DeleteTaskRequest extends Request
{
    public function dto(): string
    {
        return DeleteTaskDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid'  => $this->route('uuid', default: null),
            'force' => $this->input('force', default: false),
        ];
    }
}
