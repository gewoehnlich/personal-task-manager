<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteBillDto extends Dto
{
    public function __construct(
        public readonly Bill $bill,
        public readonly bool $force,
    ) {
        //
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
