<?php

namespace App\Containers\Bills\Dto;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Containers\Bills\Values\DescriptionValue;
use App\Containers\Bills\Values\MinutesSpentValue;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Dto\Dto;

final readonly class UpdateBillDto extends Dto
{
    public function __construct(
        private readonly Bill $bill,
        private readonly ?DescriptionValue $description = null,
        private readonly ?MinutesSpentValue $minutesSpent = null,
        private readonly ?PerformedAtValue $performedAt = null,
    ) {
        //
    }

    public function bill(): Bill
    {
        return $this->bill;
    }

    public function description(): ?string
    {
        return $this->description?->value();
    }

    public function minutesSpent(): ?int
    {
        return $this->minutesSpent?->value();
    }

    public function performedAt(): ?string
    {
        return $this->performedAt?->value();
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            bill: BillRepository::byUuid(
                uuid: $inputData['uuid'],
                taskUuid: $inputData['task_uuid'],
            ),
            description: DescriptionValue::fromNullable(
                input: $inputData['description'],
            ),
            minutesSpent: MinutesSpentValue::fromNullable(
                input: $inputData['minutes_spent'],
            ),
            performedAt: PerformedAtValue::fromNullable(
                value: $inputData['performed_at'],
            ),
        );
    }
}
