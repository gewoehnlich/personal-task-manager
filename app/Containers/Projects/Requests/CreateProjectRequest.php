<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Ship\Parents\Requests\Request;

final class CreateProjectRequest extends Request
{
    public function transporter(): string
    {
        return CreateProjectTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'      => ['required', 'integer', 'exists:users,id'],
            'name'         => ['required', 'string',  'max:255'],
            'description'  => ['nullable', 'string',  'max:65535'],
            'deleted'      => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}
