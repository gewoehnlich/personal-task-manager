<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Dto\RestoreBillDto;
use App\Ship\Abstracts\Requests\Request;

final class RestoreBillRequest extends Request
{
    public function dto(): string
    {
        return RestoreBillDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid' => $this->route('uuid', default: null),
            'task_uuid' => $this->route('task', default: null),
        ];
    }
}
