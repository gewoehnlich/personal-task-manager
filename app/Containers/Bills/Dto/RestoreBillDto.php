<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class RestoreBillDto extends Dto
{
    public function __construct(
        private readonly Bill $bill,
    ) {
        //
    }

    public function bill(): Bill
    {
        return $this->bill;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            bill: BillRepository::byUuid(
                uuid: $inputData['uuid'],
                taskUuid: $inputData['task_uuid'],
            ),
        );
    }
}
