<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Ship\Abstracts\Requests\Request;

final class IndexProjectsRequest extends Request
{
    public function dto(): string
    {
        return IndexProjectsDto::class;
    }

    protected function extract(): array
    {
        return [
            'user' => $this->user(),
        ];
    }
}
