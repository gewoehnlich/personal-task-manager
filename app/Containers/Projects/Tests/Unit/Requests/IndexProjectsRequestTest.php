<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Requests\IndexProjectsRequest;
use App\Ship\Abstracts\Tests\TestCase;

final class IndexProjectsRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
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
            message: "toDto() method should create IndexProjectsDto",
        );
    }
}
