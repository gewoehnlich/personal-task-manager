<?php

namespace App\Containers\Bills\Tests\Unit\Dto;

use App\Containers\Bills\Dto\IndexBillsDto;
use App\Containers\Bills\Enums\DeletedEnum;
use App\Containers\Bills\Enums\OrderByEnum;
use App\Containers\Bills\Enums\OrderByFieldEnum;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(IndexBillsDto::class)]
#[Small]
final class IndexBillsDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $bill = $this->bill(
            task: $task,
        );

        $description = 'description';

        $minutesSpent = 60;

        $deleted = DeletedEnum::ONLY;

        $createdAtFrom = $this->datetimeString();

        $createdAtTo = $this->datetimeString();

        $updatedAtFrom = $this->datetimeString();

        $updatedAtTo = $this->datetimeString();

        $deletedAtFrom = $this->datetimeString();

        $deletedAtTo = $this->datetimeString();

        $performedAtFrom = $this->datetimeString();

        $performedAtTo = $this->datetimeString();

        $orderBy = OrderByEnum::ASC;

        $orderByField = OrderByFieldEnum::CREATED_AT;

        $limit = 2;

        $dto = IndexBillsDto::from([
            'user'              => $user,
            'uuid'              => $bill->uuid,
            'task_uuid'         => $task->uuid,
            'description'       => $description,
            'minutes_spent'     => $minutesSpent,
            'deleted'           => $deleted->value,
            'created_at_from'   => $createdAtFrom,
            'created_at_to'     => $createdAtTo,
            'updated_at_from'   => $updatedAtFrom,
            'updated_at_to'     => $updatedAtTo,
            'deleted_at_from'   => $deletedAtFrom,
            'deleted_at_to'     => $deletedAtTo,
            'performed_at_from' => $performedAtFrom,
            'performed_at_to'   => $performedAtTo,
            'order_by'          => $orderBy->value,
            'order_by_field'    => $orderByField->value,
            'limit'             => $limit,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
        );

        $this->assertSame(
            expected: $bill->uuid,
            actual: $dto->bill->uuid,
        );

        $this->assertSame(
            expected: $task->uuid,
            actual: $dto->task->uuid,
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description->value(),
        );

        $this->assertSame(
            expected: $minutesSpent,
            actual: $dto->minutesSpent->value(),
        );

        $this->assertSame(
            expected: $deleted,
            actual: $dto->deleted,
        );

        $this->assertSame(
            expected: $createdAtFrom,
            actual: $dto->createdAtFrom->value(),
        );

        $this->assertSame(
            expected: $createdAtTo,
            actual: $dto->createdAtTo->value(),
        );

        $this->assertSame(
            expected: $updatedAtFrom,
            actual: $dto->updatedAtFrom->value(),
        );

        $this->assertSame(
            expected: $updatedAtTo,
            actual: $dto->updatedAtTo->value(),
        );

        $this->assertSame(
            expected: $deletedAtFrom,
            actual: $dto->deletedAtFrom->value(),
        );

        $this->assertSame(
            expected: $deletedAtTo,
            actual: $dto->deletedAtTo->value(),
        );

        $this->assertSame(
            expected: $performedAtFrom,
            actual: $dto->performedAtFrom->value(),
        );

        $this->assertSame(
            expected: $performedAtTo,
            actual: $dto->performedAtTo->value(),
        );

        $this->assertSame(
            expected: $orderBy,
            actual: $dto->orderBy,
        );

        $this->assertSame(
            expected: $orderByField,
            actual: $dto->orderByField,
        );

        $this->assertSame(
            expected: $limit,
            actual: $dto->limit,
        );
    }

    public function testFromMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $dto = IndexBillsDto::from([
            'user'              => $user,
            'uuid'              => null,
            'task_uuid'         => null,
            'description'       => null,
            'minutes_spent'     => null,
            'deleted'           => null,
            'created_at_from'   => null,
            'created_at_to'     => null,
            'updated_at_from'   => null,
            'updated_at_to'     => null,
            'deleted_at_from'   => null,
            'deleted_at_to'     => null,
            'performed_at_from' => null,
            'performed_at_to'   => null,
            'order_by'          => null,
            'order_by_field'    => null,
            'limit'             => null,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
        );
    }
}
