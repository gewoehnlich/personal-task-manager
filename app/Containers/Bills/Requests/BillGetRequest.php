<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\BillGetTransporter;
use App\Ship\Parents\Requests\Request;

final class BillGetRequest extends Request
{
    public function transporter(): string
    {
        return BillGetTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_id' => ['required', 'integer', 'exists:tasks,id'],
        ];
    }

    public function after(): array
    {
        return [
            //
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'task_id' => $this->route('task'),
        ]);
    }
}
