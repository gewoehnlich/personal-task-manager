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
            'user_uuid'     => ['required', 'uuid:7'],
            'task_uuid'     => ['required', 'uuid:7'],
            'description'   => ['nullable', 'string', 'max:500'],
            'minutes_spent' => ['required', 'integer', 'max:65535'],
            'performed_at'  => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->performed_at > Carbon::now()) {
                    $validator->errors()->add(
                        'performed_at',
                        'performed_at не должен быть раньше текущего времени.',
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_uuid' => $this->user()->uuid,
            'task_uuid' => $this->route('task_uuid'),
        ]);
    }
}
