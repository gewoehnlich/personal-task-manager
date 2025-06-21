<?php

namespace App\Http\Requests\API\Tasks;

use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;
use App\Enums\API\Tasks\Stage;
use App\Http\Requests\API\Tasks\TaskRequest;

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
            'id'          => 'integer',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'stage'       => ['required', new Enum(Stage::class)],
            'deadline'    => 'date|date_format:Y-m-d H:i:s'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->deadline < Carbon::now()) {
                    $validator->errors()->add(
                        'deadline',
                        '\'deadline\' не должно быть меньше текущего времени.'
                    );
                }
            }
        ];
    }
}
