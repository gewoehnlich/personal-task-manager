<?php

namespace App\Containers\Projects\Tests\Unit\Requests;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(CreateProjectRequest::class)]
#[Small]
#[UsesClass(CreateProjectDto::class)]
final class CreateProjectRequestTest extends TestCase
{
    #[TestDox('CreateProjectRequest should be convertable to CreateProjectDto')]
    public function testToDtoMethod(): void
    {
        $userUuid = User::factory()
            ->create()
            ->uuid;

        $title = 'title';

        $description = 'description';
    }
}
