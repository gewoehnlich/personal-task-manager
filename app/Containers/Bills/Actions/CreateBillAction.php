<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\CreateBillDto;
use App\Containers\Bills\Models\Bill;
use App\Ship\Abstracts\Actions\Action;

final readonly class CreateBillAction extends Action
{
    public function run(
        CreateBillDto $dto,
    ): Bill {
        return Bill::create([
            'task_uuid'     => $dto->task->uuid,
            'description'   => $dto->description?->value(),
            'minutes_spent' => $dto->minutesSpent?->value(),
            'performed_at'  => $dto->performedAt?->value(),
        ]);
    }
}
