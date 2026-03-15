<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\RestoreProjectDto;
use App\Ship\Abstracts\Requests\Request;

final class RestoreProjectRequest extends Request
{
    public function dto(): string
    {
        return RestoreProjectDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid' => $this->route('uuid', default: null),
        ];
    }
}
