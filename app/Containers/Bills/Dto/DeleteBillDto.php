<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteBillDto extends Dto
{
    public function __construct(
        private readonly Bill $bill,
        private readonly bool $force,
    ) {
        //
    }

    public function bill(): Bill
    {
        return $this->bill;
    }

    public function force(): bool
    {
        return $this->force;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            bill: BillRepository::byUuid(
                uuid: $inputData['uuid'],
                taskUuid: $inputData['task_uuid'],
            ),
            force: $inputData['force'],
        );
    }
}
