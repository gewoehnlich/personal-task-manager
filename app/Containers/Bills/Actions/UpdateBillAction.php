<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\UpdateBillDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class UpdateBillAction extends Action
{
    public function run(
        UpdateBillDto $dto,
    ): bool {
        return $dto->bill()->update([
            'description'   => $dto->description(),
            'minutes_spent' => $dto->minutesSpent(),
            'performed_at'  => $dto->performedAt(),
        ]);
    }
}
