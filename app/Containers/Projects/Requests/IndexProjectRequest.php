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
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}
