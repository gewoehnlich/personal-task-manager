<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;

final class CreateProjectRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
    {
        $user = $this->user();

        $request = $this->request(
            parameters: [
                'title' => 'title',
                'description' => 'description',
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: CreateProjectDto::class,
            actual: $dto,
            message: "toDto() method should create CreateProjectDto",
        );
    }

    private function request(
        array $parameters,
        User $user,
    ): CreateProjectRequest {
        return $this->createRequestObject(
            class: CreateProjectRequest::class,
            routeName: route('api.v1.projects.create'),
            method: 'POST',
            parameters: $parameters,
            user: $user,
        );
    }
}
