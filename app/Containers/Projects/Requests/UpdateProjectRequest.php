<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\UpdateProjectTransporter;
use App\Ship\Abstracts\Requests\Request;

final class UpdateProjectRequest extends Request
{
    public function transporter(): string
    {
        return UpdateProjectTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'         => ['required', 'uuid:7'],
            'user_uuid'    => ['required', 'uuid:7'],
            'name'         => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string', 'max:500'],
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
