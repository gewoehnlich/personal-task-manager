<?php

namespace App\Containers\Projects\Tests\Unit\Requests;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class CreateProjectRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: CreateProjectRequest::class,
            routeName: 'api.v1.projects.create',
            method: 'POST',
            parameters: [
                'title'       => 'title',
                'description' => 'description',
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: CreateProjectDto::class,
            actual: $dto,
            message: 'toDto() method should create CreateProjectDto',
        );
    }
}
