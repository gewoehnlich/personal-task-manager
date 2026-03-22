<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Ship\Abstracts\Requests\Request;

final class IndexTasksRequest extends Request
{
    public function dto(): string
    {
        return IndexTasksDto::class;
    }

    protected function extract(): array
    {
        return [
            'user'            => $this->user(),
            'uuid'            => $this->input('uuid', default: null),
            'title'           => $this->input('title', default: null),
            'project_uuid'    => $this->input('project_uuid', default: null),
            'description'     => $this->input('description', default: null),
            'stage'           => $this->input('stage', default: null),
            'created_at_from' => $this->input('created_at_from', default: null),
            'created_at_to'   => $this->input('created_at_to', default: null),
            'updated_at_from' => $this->input('updated_at_from', default: null),
            'updated_at_to'   => $this->input('updated_at_to', default: null),
            'deleted_at_from' => $this->input('deleted_at_from', default: null),
            'deleted_at_to'   => $this->input('deleted_at_to', default: null),
            'deadline_from'   => $this->input('deadline_from', default: null),
            'deadline_to'     => $this->input('deadline_to', default: null),
            'order_by'        => $this->input('order_by', default: null),
            'order_by_field'  => $this->input('order_by_field', default: null),
            'deleted'         => $this->input('deleted', default: null),
            'limit'           => $this->input('limit', default: null),
        ];
    }
}
