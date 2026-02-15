<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(UpdateProjectDto::class)]
#[Small]
final class UpdateProjectDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $title,
        ?string $description,
    ): void {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $dto = UpdateProjectDto::from([
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: [
                'uuid'        => $project->uuid,
                'user_uuid'   => $user->uuid,
                'title'       => $title,
                'description' => $description,
            ],
            actual: $dto->toArray(),
        );
    }

    #[TestDox('uuid() method should return a string')]
    public function testUuidMethod(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $data = [
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => 'title',
            'description' => 'description',
        ];

        $dto = UpdateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->uuid->uuid,
            actual: $dto->uuid(),
            message: 'uuid() method should return actual value',
        );
    }

    #[TestDox('userUuid() method should return a string')]
    public function testUserUuidMethod(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $data = [
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => 'title',
            'description' => 'description',
        ];

        $dto = UpdateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->userUuid->uuid,
            actual: $dto->userUuid(),
            message: 'userUuid() method should return actual value',
        );
    }

    #[TestDox('title() method should return a string')]
    public function testTitleMethod(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $data = [
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => 'title',
            'description' => 'description',
        ];

        $dto = UpdateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->title->string,
            actual: $dto->title(),
            message: 'title() method should return actual value',
        );
    }

    #[DataProvider('data')]
    #[TestDox('description() method should return a string or null')]
    public function testDescriptionMethod(
        string $title,
        ?string $description,
    ): void {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $data = [
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => $title,
            'description' => $description,
        ];

        $dto = UpdateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->description?->string,
            actual: $dto->description(),
            message: 'description() method should return actual value',
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                'title',       // title
                'description', // description
            ],
            'null description' => [
                'title', // title
                null,    // description
            ],
        ];
    }
}
