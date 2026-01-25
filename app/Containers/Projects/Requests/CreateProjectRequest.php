<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Ship\Abstracts\Requests\Request;

final class CreateProjectRequest extends Request
{
    public function dto(): string
    {
        return CreateProjectDto::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_uuid'   => ['required'],
            'title'       => ['required'],
            'description' => ['nullable'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
