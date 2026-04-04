<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\RestoreBillDto;
use App\Containers\Bills\Exceptions\BillIsNotSoftDeletedException;
use App\Ship\Abstracts\Actions\Action;

final readonly class RestoreBillAction extends Action
{
    public function run(
        RestoreBillDto $dto,
    ): bool {
        if ($dto->bill->trashed() === false) {
            throw new BillIsNotSoftDeletedException(
                uuid: $dto->bill->uuid,
            );
        }

        return $dto->bill->restore();
    }
}
