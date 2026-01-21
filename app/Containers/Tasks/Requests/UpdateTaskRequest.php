<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Ship\Abstracts\Requests\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class UpdateTaskRequest extends Request
{
    public function dto(): string
    {
        return UpdateTaskDto::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'         => ['required', 'uuid:7', 'exists:tasks,uuid'],
            'user_uuid'    => ['required', 'uuid:7', 'exists:users,uuid'],
            'title'        => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string', 'max:500'],
            'stage'        => ['required', Rule::enum(Stage::class)],
            'deadline'     => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'project_uuid' => ['nullable', 'integer', 'exists:projects,uuid'],
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
            'uuid'      => $this->route('uuid'),
            'user_uuid' => $this->user()->uuid,
        ]);
    }
}
