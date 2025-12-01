<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\UpdateProjectTransporter;
use App\Ship\Parents\Requests\Request;

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
            'id'           => ['required', 'integer', 'exists:projects,id'],
            'user_id'      => ['required', 'integer', 'exists:users,id'],
            'name'         => ['required', 'string',  'max:255'],
            'description'  => ['nullable', 'string',  'max:65535'],
            'deleted'      => ['nullable', 'boolean'],
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
