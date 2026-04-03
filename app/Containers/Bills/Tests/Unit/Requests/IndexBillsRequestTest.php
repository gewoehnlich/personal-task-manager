<?php

namespace App\Containers\Bills\Tests\Unit\Requests;

use App\Containers\Bills\Dto\IndexBillsDto;
use App\Containers\Bills\Enums\DeletedEnum;
use App\Containers\Bills\Enums\OrderByEnum;
use App\Containers\Bills\Enums\OrderByFieldEnum;
use App\Containers\Bills\Requests\IndexBillsRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class IndexBillsRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $bill = $this->bill(
            task: $task,
        );

        $request = $this->request(
            class: IndexBillsRequest::class,
            routeName: 'api.v1.bills.index',
            method: 'GET',
            parameters: [
                'uuid'              => $bill->uuid,
                'task_uuid'         => $task->uuid,
                'description'       => 'description',
                'minutes_spent'     => 60,
                'deleted'           => DeletedEnum::ONLY->value,
                'created_at_from'   => $this->datetimeString(),
                'created_at_to'     => $this->datetimeString(),
                'updated_at_from'   => $this->datetimeString(),
                'updated_at_to'     => $this->datetimeString(),
                'deleted_at_from'   => $this->datetimeString(),
                'deleted_at_to'     => $this->datetimeString(),
                'performed_at_from' => $this->datetimeString(),
                'performed_at_to'   => $this->datetimeString(),
                'order_by'          => OrderByEnum::ASC->value,
                'order_by_field'    => OrderByFieldEnum::CREATED_AT->value,
                'limit'             => 1,
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexBillsDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexBillsDto',
        );
    }

    public function testToDtoMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: IndexBillsRequest::class,
            routeName: 'api.v1.bills.index',
            method: 'GET',
            parameters: [],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexBillsDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexBillsDto',
        );
    }
}
