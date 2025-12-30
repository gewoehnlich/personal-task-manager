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
            'user_uuid'   => ['required', 'uuid:7'],
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
