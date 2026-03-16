<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Enums\OrderByEnum;
use App\Containers\Projects\Enums\OrderByFieldEnum;
use App\Containers\Projects\Requests\IndexProjectsRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class IndexProjectsRequestTest extends TestCase
{
    public function testToDtoMethodWithNullableParametersBeingNullShouldCreateTheDto(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: IndexProjectsRequest::class,
            routeName: 'api.v1.projects.index',
            method: 'GET',
            parameters: [],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexProjectsDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexProjectsDto',
        );
    }

    public function testToDtoMethodWithAllParametersFilledShouldCreateTheDto(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            class: IndexProjectsRequest::class,
            routeName: 'api.v1.projects.index',
            method: 'GET',
            parameters: [
                'uuid'            => $project->uuid,
                'title'           => 'title',
                'description'     => 'description',
                'deleted'         => DeletedEnum::ONLY->value,
                'created_at_from' => $this->datetimeString(),
                'created_at_to'   => $this->datetimeString(),
                'updated_at_from' => $this->datetimeString(),
                'updated_at_to'   => $this->datetimeString(),
                'deleted_at_from' => $this->datetimeString(),
                'deleted_at_to'   => $this->datetimeString(),
                'order_by'        => OrderByEnum::ASC->value,
                'order_by_field'  => OrderByFieldEnum::CREATED_AT->value,
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: IndexProjectsDto::class,
            actual: $dto,
            message: 'toDto() method should create IndexProjectsDto',
        );
    }
}
