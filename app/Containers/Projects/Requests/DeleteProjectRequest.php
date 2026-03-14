<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Ship\Abstracts\Requests\Request;

final class DeleteProjectRequest extends Request
{
    public function dto(): string
    {
        return DeleteProjectDto::class;
    }

    protected function extract(): array
    {
        return [
            'user'  => $this->user(),
            'uuid'  => $this->route('uuid', default: null),
            'force' => $this->input('force', default: false),
        ];
    }
}
