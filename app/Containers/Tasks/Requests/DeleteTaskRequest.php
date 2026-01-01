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
            'id'      => ['required', 'integer', 'exists:tasks,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id'      => $this->route('id'),
            'user_id' => $this->user()->id,
        ]);
    }
}
