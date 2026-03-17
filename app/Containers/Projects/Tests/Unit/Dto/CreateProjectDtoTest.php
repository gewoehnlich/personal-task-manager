<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\CreateProjectDto;
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
    #[DataProvider('inputDataProvider')]
    #[TestDox('dto should be creatable with from() method')]
    public function testFromMethodDtoCreation(
        string $title,
        ?string $description,
    ): void {
        $user = $this->user();

        $dto = CreateProjectDto::from([
            'user'        => $user,
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
