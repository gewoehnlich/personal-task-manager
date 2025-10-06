<?php

namespace App\Containers\Bills\Requests;

use App\Containers\Bills\Transporters\BillDeleteTransporter;
use App\Ship\Parents\Requests\Request;

final class BillDeleteRequest extends Request
{
    public function transporter(): string
    {
        return BillDeleteTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'      => ['required', 'integer', 'exists:bills,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
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
            'id'      => $this->route('id'),
            'user_id' => $this->user()->id,
            'task_id' => $this->route('task'),
        ]);
    }
}
