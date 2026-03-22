<?php

namespace App\Containers\Tasks\Tests\Unit\Requests;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\DeletedEnum;
use App\Containers\Tasks\Enums\OrderByEnum;
use App\Containers\Tasks\Enums\OrderByFieldEnum;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Requests\IndexTasksRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class IndexTasksRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $request = $this->request(
            class: IndexTasksRequest::class,
            routeName: 'api.v1.tasks.index',
            method: 'GET',
            parameters: [
                'uuid'            => $task->uuid,
                'title'           => 'title',
                'project_uuid'    => $this->project(
                    user: $user,
                )
                    ->uuid,
                'description'     => 'description',
                'stage'           => StageEnum::PENDING->value,
                'created_at_from' => $this->datetimeString(),
                'created_at_to'   => $this->datetimeString(),
                'updated_at_from' => $this->datetimeString(),
                'updated_at_to'   => $this->datetimeString(),
                'deleted_at_from' => $this->datetimeString(),
                'deleted_at_to'   => $this->datetimeString(),
                'deadline_from'   => $this->datetimeString(),
                'deadline_to'     => $this->datetimeString(),
                'order_by'        => OrderByEnum::ASC->value,
                'order_by_field'  => OrderByFieldEnum::CREATED_AT->value,
                'deleted'         => DeletedEnum::ONLY->value,
                'limit'           => 2,
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexTasksDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexTasksDto',
        );
    }

    public function testToDtoMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: IndexTasksRequest::class,
            routeName: 'api.v1.tasks.index',
            method: 'GET',
            parameters: [],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexTasksDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexTasksDto',
        );
    }
}
