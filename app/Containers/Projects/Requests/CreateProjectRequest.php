<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Ship\Abstracts\Requests\Request;

final class CreateProjectRequest extends Request
{
    public function dto(): string
    {
        return CreateProjectDto::class;
    }

    protected function extract(): array
    {
        return [
            'user'        => $this->user(),
            'title'       => $this->input('title', default: null),
            'description' => $this->input('description', default: null),
        ];
    }
}
