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

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_uuid' => ['required', 'uuid:7'],
        ];
    }

    public function after(): array
    {
        return [
            //
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'task_uuid' => $this->route('task_uuid'),
        ]);
    }
}
