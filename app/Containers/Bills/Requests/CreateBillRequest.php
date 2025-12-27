<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\CreateBillTransporter;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;

final class CreateBillRequest extends Request
{
    public function transporter(): string
    {
        return CreateBillTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'      => ['required', 'integer', 'exists:users,id'],
            'task_id'      => ['required', 'integer', 'exists:tasks,id'],
            'description'  => ['nullable', 'string',  'max:65535'],
            'time_spent'   => ['required', 'integer', 'min:1'],
            'performed_at' => ['nullable', 'date',    'date_format:Y-m-d H:i:s'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->performed_at > Carbon::now()) {
                    $validator->errors()->add(
                        'performed_at',
                        'performed_at не должен быть раньше текущего времени.'
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
            'task_id' => $this->route('task'),
        ]);
    }
}
