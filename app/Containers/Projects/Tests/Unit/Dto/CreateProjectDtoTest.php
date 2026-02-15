<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(CreateProjectDto::class)]
#[Small]
final class CreateProjectDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('dto should be creatable with from() method')]
    public function testFromMethodDtoCreation(
        string $title,
        ?string $description,
    ): void {
        $user = User::factory()
            ->create();

        $dto = CreateProjectDto::from([
            'user_uuid'   => $user->uuid,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->userUuid(),
            message: 'userUuid should be the same',
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title(),
            message: 'title should be the same',
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description(),
            message: 'description should be the same',
        );
    }

    #[DataProvider('data')]
    #[TestDox('dto should be convertable to array with toArray() method')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $title,
        ?string $description,
    ): void {
        $data = [
            'user_uuid'   => User::factory()
                ->create()
                ->uuid,
            'title'       => $title,
            'description' => $description,
        ];

        $dto = CreateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
        );
    }

    #[DataProvider('data')]
    #[TestDox('userUuid() method should return a string')]
    public function testUserUuidMethod(
        string $title,
        ?string $description,
    ): void {
        $data = [
            'user_uuid'   => User::factory()
                ->create()
                ->uuid,
            'title'       => $title,
            'description' => $description,
        ];

        $dto = CreateProjectDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $dto->userUuid->uuid,
            actual: $dto->userUuid(),
            message: 'userUuid() method should return actual value',
        );
    }

    #[DataProvider('data')]
    #[TestDox('title() method should return a string')]
    public function testTitleMethod(
        string $title,
        ?string $description,
    ): void {
        $data = [
            'user_uuid'   => User::factory()
                ->create()
                ->uuid,
            'title'       => $title,
            'description' => $description,
        ];

        $dto = CreateProjectDto::from(
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
        $data = [
            'user_uuid'   => User::factory()
                ->create()
                ->uuid,
            'title'       => $title,
            'description' => $description,
        ];

        $dto = CreateProjectDto::from(
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
