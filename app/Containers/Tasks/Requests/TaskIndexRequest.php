<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Transporters\TaskIndexTransporter;
use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class TaskIndexRequest extends Request
{
    public function transporter(): string
    {
        return TaskIndexTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'         => ['required', 'exists:users,id'],
            'id'              => ['nullable', 'integer', 'exists:tasks,id'],
            'stage'           => ['nullable', 'string', Rule::enum(Stage::class)],
            'parent_id'       => ['nullable', 'integer', 'exists:tasks,id'],
            'project_id'      => ['nullable', 'integer', 'exists:projects,id'],
            'created_at_from' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'created_at_to'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'updated_at_from' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'updated_at_to'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'deadline_from'   => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'deadline_to'     => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
            'order_by'        => ['nullable', 'string', 'in:asc,desc'],
            'order_by_field'  => ['nullable', 'string', 'in:id,created_at,updated_at,deadline,stage'],
            'limit'           => ['nullable', 'integer'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    $this->createdAtFrom &&
                    $this->createdAtTo &&
                    $this->createdAtFrom > $this->createdAtTo
                ) {
                    $validator->errors()->add(
                        'created_at_range',
                        'created_at_from не может быть позже created_at_to.'
                    );
                }

                if (
                    $this->updatedAtFrom &&
                    $this->updatedAtTo &&
                    $this->updatedAtFrom > $this->updatedAtTo
                ) {
                    $validator->errors()->add(
                        'updated_at_range',
                        'updated_at_from не может быть позже updated_at_to.'
                    );
                }

                if (
                    $this->deadlineFrom &&
                    $this->deadlineTo &&
                    $this->deadlineFrom > $this->deadlineTo
                ) {
                    $validator->errors()->add(
                        'deadline_range',
                        'deadline_from не может быть позже deadline_to.'
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}
