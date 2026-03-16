<?php

namespace App\Containers\Projects\Tests\Unit\Requests;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class DeleteProjectRequestTest extends TestCase
{
    public function testToDtoMethodDtoCreation(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            class: DeleteProjectRequest::class,
            routeName: 'api.v1.projects.delete',
            method: 'DELETE',
            parameters: [],
            user: $user,
            routeParameters: [
                'uuid' => $project->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: DeleteProjectDto::class,
            actual: $dto,
            message: 'toDto() method should create DeleteProjectDto',
        );
    }
}
