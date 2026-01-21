<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\Stage;
use App\Ship\Abstracts\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class IndexTasksRequest extends Request
{
    public function dto(): string
    {
        return IndexTasksDto::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_uuid'       => ['required', 'uuid:7'],
            'uuid'            => ['nullable', 'uuid:7', 'exists:tasks,uuid'],
            'stage'           => ['nullable', Rule::enum(Stage::class)],
            'project_uuid'    => ['nullable', 'uuid:7', 'exists:projects,uuid'],
            'created_at_from' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'created_at_to'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'updated_at_from' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'updated_at_to'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'deadline_from'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'deadline_to'     => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'order_by'        => ['nullable', 'string', 'in:asc,desc'],
            'order_by_field'  => ['nullable', 'string', 'in:id,created_at,updated_at,deadline,stage'],
            'limit'           => ['nullable', 'integer'],
            'with_deleted'    => ['nullable', 'boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    $this->createdAtFrom
                    && $this->createdAtTo
                    && $this->createdAtFrom > $this->createdAtTo
                ) {
                    $validator->errors()->add(
                        'created_at_range',
                        'created_at_from не может быть позже created_at_to.',
                    );
                }

                if (
                    $this->updatedAtFrom
                    && $this->updatedAtTo
                    && $this->updatedAtFrom > $this->updatedAtTo
                ) {
                    $validator->errors()->add(
                        'updated_at_range',
                        'updated_at_from не может быть позже updated_at_to.',
                    );
                }

                if (
                    $this->deadlineFrom
                    && $this->deadlineTo
                    && $this->deadlineFrom > $this->deadlineTo
                ) {
                    $validator->errors()->add(
                        'deadline_range',
                        'deadline_from не может быть позже deadline_to.',
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
