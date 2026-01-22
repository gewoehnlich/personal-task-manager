<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Ship\Abstracts\Requests\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class CreateTaskRequest extends Request
{
    public function dto(): string
    {
        return CreateTaskDto::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_uuid'    => ['required', 'uuid:7', 'exists:users,uuid'],
            'title'        => ['required', 'string'],
            'description'  => ['nullable', 'string'],
            'stage'        => ['required', Rule::enum(type: Stage::class)],
            'deadline'     => ['nullable', 'date', 'date_format:' . DeadlineValue::FORMAT],
            'project_uuid' => ['nullable', 'uuid:7', 'exists:projects,uuid'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (isset($this->deadline) && $this->deadline < Carbon::now()) {
                    $validator->errors()->add(
                        'deadline',
                        'deadline не должен быть меньше текущего времени.',
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
