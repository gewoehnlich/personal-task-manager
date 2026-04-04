<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\DeleteBillDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteBillAction extends Action
{
    public function run(
        DeleteBillDto $dto,
    ): bool {
        if ($dto->force === true) {
            return $dto->bill->forceDelete();
        }

        return $dto->bill->delete();
    }
}
