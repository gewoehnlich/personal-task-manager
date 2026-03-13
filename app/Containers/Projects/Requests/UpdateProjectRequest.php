<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Ship\Abstracts\Requests\Request;

final class UpdateProjectRequest extends Request
{
    public function dto(): string
    {
        return UpdateProjectDto::class;
    }

    public function extract(): array
    {
        return [
            'uuid'        => $this->route('uuid', default: null),
            'user'        => $this->user(),
            'title'       => $this->input('title', default: null),
            'description' => $this->input('description', default: null),
        ];
    }
}
