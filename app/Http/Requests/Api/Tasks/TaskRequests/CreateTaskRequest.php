<?php

namespace App\Http\Requests\Api\Tasks\TaskRequests;

use App\Http\Requests\Api\Tasks\TaskRequest;

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
            'title' => 'required|max:255',
            'description' => 'nullable|max:65535',
            'taskStatus' => 'enum',
            'deadline'
        ];
    }
}
