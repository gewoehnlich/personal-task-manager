<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\RestoreTaskDto;
use App\Ship\Abstracts\Requests\Request;

final class RestoreTaskRequest extends Request
{
    public function dto(): string
    {
        return RestoreTaskDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid' => $this->route('uuid', default: null),
        ];
    }
}
