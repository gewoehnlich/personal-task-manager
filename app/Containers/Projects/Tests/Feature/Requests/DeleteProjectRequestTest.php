<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;

final class DeleteProjectRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            parameters: [],
            user: $user,
            project: $project,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: DeleteProjectDto::class,
            actual: $dto,
            message: "toDto() method should create DeleteProjectDto",
        );
    }

    private function request(
        array $parameters,
        User $user,
        Project $project,
    ): DeleteProjectRequest {
        return $this->createRequestObject(
            class: DeleteProjectRequest::class,
            routeName: 'api.v1.projects.delete',
            method: 'DELETE',
            parameters: $parameters,
            user: $user,
            routeParameters: [
                'uuid' => $project->uuid,
            ],
        );
    }
}
