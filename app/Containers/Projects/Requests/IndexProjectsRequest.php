<?php

namespace App\Containers\Projects\Requests;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Ship\Abstracts\Requests\Request;

final class IndexProjectsRequest extends Request
{
    public function dto(): string
    {
        return IndexProjectsDto::class;
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
