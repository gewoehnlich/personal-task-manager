<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;

final class UpdateProjectRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            parameters: [
                'title' => 'title',
                'description' => 'description',
            ],
            user: $user,
            project: $project,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: UpdateProjectDto::class,
            actual: $dto,
            message: "toDto() method should create UpdateProjectDto",
        );
    }

    private function request(
        array $parameters,
        User $user,
        Project $project,
    ): UpdateProjectRequest {
        return $this->createRequestObject(
            class: UpdateProjectRequest::class,
            routeName: 'api.v1.projects.update',
            method: 'PUT',
            parameters: $parameters,
            user: $user,
            routeParameters: [
                'uuid' => $project->uuid,
            ],
        );
    }
}
