<?php

namespace App\Http\Requests\Api\Tasks;

use Illuminate\Validation\Validator;

class ReadTaskRequest extends TaskRequest
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
            'start' => 'nullable|date|date_format:Y-m-d H:i:s',
            'end' => 'nullable|date|date_format:Y-m-d H:i:s'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    $this->start && ! $this->end ||
                    ! $this->start && $this->end
                ) {
                    $validator->errors()->add(
                        '\'Start\' и \'End\'',
                        'Поля \'Start\' и \'End\' должны быть либо оба пустыми, либо оба заполнеными.'
                    );
                }

                if (
                    $this->start &&
                    $this->end &&
                    $this->start > $this->end
                ) {
                    $validator->errors()->add(
                        '\'Start\' и \'End\'',
                        'Поле \'Start\' не может быть позднее \'End\'.'
                    );
                }
            }
        ];
    }
}
