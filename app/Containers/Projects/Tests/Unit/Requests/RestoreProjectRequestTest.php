<?php

namespace App\Containers\Projects\Tests\Unit\Requests;

use App\Containers\Projects\Dto\RestoreProjectDto;
use App\Containers\Projects\Requests\RestoreProjectRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(RestoreProjectRequest::class)]
#[Medium]
final class RestoreProjectRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $request = $this->request(
            class: RestoreProjectRequest::class,
            routeName: 'api.v1.projects.restore',
            method: 'POST',
            parameters: [],
            user: $user,
            routeParameters: [
                'uuid' => $project->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: RestoreProjectDto::class,
            actual: $dto,
            message: 'toDto() method should create RestoreProjectDto',
        );
    }
}
