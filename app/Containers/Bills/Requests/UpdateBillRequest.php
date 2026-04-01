<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Dto\UpdateBillDto;
use App\Ship\Abstracts\Requests\Request;

final class UpdateBillRequest extends Request
{
    public function dto(): string
    {
        return UpdateBillDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid'          => $this->route('uuid'),
            'task_uuid'     => $this->route('task'),
            'description'   => $this->input('description', default: null),
            'minutes_spent' => $this->input('minutes_spent', default: null),
            'performed_at'  => $this->input('performed_at', default: null),
        ];
    }
}
