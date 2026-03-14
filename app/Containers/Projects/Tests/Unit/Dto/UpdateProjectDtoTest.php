<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
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
    #[DataProvider('inputDataProvider')]
    #[TestDox('from() method should create a dto with valid project uuid')]
    public function testFromMethodDtoCreationWithExistingProjectUuid(
        string $title,
        ?string $description,
    ): void {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $dto = UpdateProjectDto::from([
            'project'     => $project,
            'user'        => $user,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->project->uuid,
            message: "the value should be the same as expected",
        );

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
            message: "the value should be the same as expected",
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title->value(),
            message: "the value should be the same as expected",
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description->value(),
            message: "the value should be the same as expected",
        );
    }

    #[TestDox('from() method should throw an exception with invalid project uuid')]
    public function testFromMethodShouldThrowAnExceptionWithInvalidProjectUuid(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        UpdateProjectDto::from([
            'project'     => $user, // not actual project
            'user'        => $user,
            'title'       => 'title',
            'description' => 'description',
        ]);
    }

    #[DataProvider('inputDataProvider')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $title,
        ?string $description,
    ): void {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $dto = UpdateProjectDto::from([
            'project'     => $project,
            'user'        => $user,
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

    public static function inputDataProvider(): array
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
