<?php

namespace App\Containers\Tasks\Requests;

use App\Enums\API\Tasks\Stage;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class UpdateTaskRequest extends TaskRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:65535'],
            'stage'       => ['required', Rule::enum(Stage::class)],
            'deadline'    => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'parent_id'   => ['nullable', 'integer', 'exists:tasks,id'],
            'project_id'  => ['nullable', 'integer', 'exists:projects,id'],
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
}
