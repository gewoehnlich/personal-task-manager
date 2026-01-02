<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Ship\Abstracts\Requests\Request;

final class DeleteTaskRequest extends Request
{
    public function transporter(): string
    {
        return DeleteTaskTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'      => ['required', 'uuid:7', 'exists:tasks,uuid'],
            'user_uuid' => ['required', 'uuid:7', 'exists:users,uuid'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uuid'      => $this->route('uuid'),
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
