<?php

namespace App\Containers\Projects\Tests\Feature\Requests;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class UpdateProjectRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            class: UpdateProjectRequest::class,
            routeName: 'api.v1.projects.update',
            method: 'PUT',
            parameters: [
                'title'       => 'title',
                'description' => 'description',
            ],
            user: $user,
            routeParameters: [
                'uuid' => $project->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: UpdateProjectDto::class,
            actual: $dto,
            message: 'toDto() method should create UpdateProjectDto',
        );
    }
}
