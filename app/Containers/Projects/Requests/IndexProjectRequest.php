<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\IndexProjectTransporter;
use App\Ship\Parents\Requests\Request;

final class IndexProjectRequest extends Request
{
    public function transporter(): string
    {
        return IndexProjectTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_uuid' => ['required', 'uuid:7'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
