<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\RestoreProjectDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class RestoreProjectDtoTest extends TestCase
{
    public function testFromMethodDtoCreation(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $dto = RestoreProjectDto::from([
            'uuid' => $project->uuid,
        ]);

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->projectUuid(),
            message: 'projectUuid has to be the same as expected',
        );
    }
}
