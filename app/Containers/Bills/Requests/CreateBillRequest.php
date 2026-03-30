<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Dto\CreateBillDto;
use App\Ship\Abstracts\Requests\Request;

final class CreateBillRequest extends Request
{
    public function dto(): string
    {
        return CreateBillDto::class;
    }

    protected function extract(): array
    {
        return [
            'task_uuid'     => $this->route('task'),
            'description'   => $this->input('description', default: null),
            'minutes_spent' => $this->input('minutes_spent', default: null),
            'performed_at'  => $this->input('performed_at', default: null),
        ];
    }
}
