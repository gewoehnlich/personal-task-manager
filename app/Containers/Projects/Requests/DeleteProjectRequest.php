<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Ship\Abstracts\Requests\Request;

final class DeleteProjectRequest extends Request
{
    public function transporter(): string
    {
        return DeleteProjectTransporter::class;
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
