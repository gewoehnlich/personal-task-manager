<?php

namespace App\Http\Requests\Api\Tasks\TaskRequests;

use App\Http\Requests\Api\Tasks\TaskRequest;
use App\Enums\TaskStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;
use Illuminate\Support\Carbon;

class CreateTaskRequest extends TaskRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'taskStatus' => ['required', new Enum(TaskStatus::class)],
            'deadline' => 'required|date|date_format:Y-m-d H:i:s'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->deadline < Carbon::now()) {
                    $validator->errors()->add(
                        'deadline',
                        'Поле \'deadline\' не должно быть меньше текущего времени.'
                    );
                }
            }
        ];
    }
}
