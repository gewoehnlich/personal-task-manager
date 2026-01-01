<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\IndexBillsTransporter;
use App\Ship\Abstracts\Requests\Request;

final class IndexBillsRequest extends Request
{
    public function transporter(): string
    {
        return IndexBillsTransporter::class;
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
