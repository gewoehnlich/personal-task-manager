<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Dto\DeleteBillDto;
use App\Ship\Abstracts\Requests\Request;

final class DeleteBillRequest extends Request
{
    public function dto(): string
    {
        return DeleteBillDto::class;
    }

    protected function extract(): array
    {
        return [
            'uuid'      => $this->route('uuid'),
            'task_uuid' => $this->route('task'),
            'force'     => $this->input('force', default: false),
        ];
    }
}
