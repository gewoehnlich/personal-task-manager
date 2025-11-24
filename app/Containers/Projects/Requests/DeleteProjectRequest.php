<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Ship\Parents\Requests\Request;

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
            'id'      => ['required', 'integer', 'exists:projects,id'],
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
