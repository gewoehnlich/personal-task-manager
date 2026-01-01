<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\DeleteBillTransporter;
use App\Ship\Abstracts\Requests\Request;

final class DeleteBillRequest extends Request
{
    public function transporter(): string
    {
        return DeleteBillTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'      => ['required', 'uuid:7'],
            'user_uuid' => ['required', 'uuid:7'],
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
            'uuid'      => $this->route('uuid'),
            'user_uuid' => $this->user()->uuid,
            'task_uuid' => $this->route('task_uuid'),
        ]);
    }
}
