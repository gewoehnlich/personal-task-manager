<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\UpdateBillTransporter;
use App\Ship\Abstracts\Requests\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;

final class UpdateBillRequest extends Request
{
    public function transporter(): string
    {
        return UpdateBillTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'          => ['required', 'uuid:7'],
            'user_uuid'     => ['required', 'uuid:7'],
            'task_uuid'     => ['required', 'uuid:7'],
            'description'   => ['nullable', 'string', 'max:500'],
            'minutes_spent' => ['nullable', 'integer', 'max:65535'],
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
            'uuid'      => $this->route('uuid'),
            'user_uuid' => $this->user()->uuid,
            'task_uuid' => $this->route('task_uuid'),
        ]);
    }
}
