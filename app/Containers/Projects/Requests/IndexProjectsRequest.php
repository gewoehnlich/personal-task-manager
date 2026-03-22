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
            'user'            => $this->user(),
            'uuid'            => $this->input('uuid', default: null),
            'title'           => $this->input('title', default: null),
            'description'     => $this->input('description', default: null),
            'deleted'         => $this->input('deleted', default: null),
            'created_at_from' => $this->input('created_at_from', default: null),
            'created_at_to'   => $this->input('created_at_to', default: null),
            'updated_at_from' => $this->input('updated_at_from', default: null),
            'updated_at_to'   => $this->input('updated_at_to', default: null),
            'deleted_at_from' => $this->input('deleted_at_from', default: null),
            'deleted_at_to'   => $this->input('deleted_at_to', default: null),
            'order_by'        => $this->input('order_by', default: null),
            'order_by_field'  => $this->input('order_by_field', default: null),
            'limit'           => $this->input('limit', default: null),
        ];
    }
}
