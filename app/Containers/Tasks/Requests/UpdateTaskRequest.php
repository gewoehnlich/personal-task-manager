<?php

namespace App\Containers\Tasks\Requests;

use App\Containers\Tasks\Transporters\UpdateTaskTransporter;
use App\Containers\Tasks\Enums\Stage;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class UpdateTaskRequest extends Request
{
    public function transporter(): string
    {
        return UpdateTaskTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'          => ['required', 'integer', 'exists:tasks,id'],
            'user_id'     => ['required', 'integer', 'exists:users,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:65535'],
            'stage'       => ['required', Rule::enum(Stage::class)],
            'deadline'    => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'parent_id'   => ['nullable', 'integer', 'exists:tasks,id'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->deadline < Carbon::now()) {
                    $validator->errors()->add(
                        'deadline',
                        'deadline не должен быть меньше текущего времени.'
                    );
                }
            },
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
