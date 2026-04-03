<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Dto\IndexBillsDto;
use App\Ship\Abstracts\Requests\Request;

final class IndexBillsRequest extends Request
{
    public function dto(): string
    {
        return IndexBillsDto::class;
    }

    protected function extract(): array
    {
        return [
            'user'              => $this->user(),
            'uuid'              => $this->input('uuid', default: null),
            'task_uuid'         => $this->input('task_uuid', default: null),
            'description'       => $this->input('description', default: null),
            'minutes_spent'     => $this->input('minutes_spent', default: null),
            'deleted'           => $this->input('deleted', default: null),
            'created_at_from'   => $this->input('created_at_from', default: null),
            'created_at_to'     => $this->input('created_at_to', default: null),
            'updated_at_from'   => $this->input('updated_at_from', default: null),
            'updated_at_to'     => $this->input('updated_at_to', default: null),
            'deleted_at_from'   => $this->input('deleted_at_from', default: null),
            'deleted_at_to'     => $this->input('deleted_at_to', default: null),
            'performed_at_from' => $this->input('performed_at_from', default: null),
            'performed_at_to'   => $this->input('performed_at_to', default: null),
            'order_by'          => $this->input('order_by', default: null),
            'order_by_field'    => $this->input('order_by_field', default: null),
            'limit'             => $this->input('limit', default: null),
        ];
    }
}
