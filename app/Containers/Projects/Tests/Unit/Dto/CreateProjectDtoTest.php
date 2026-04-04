<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(CreateProjectDto::class)]
#[Small]
final class CreateProjectDtoTest extends TestCase
{
    #[DataProvider('validInputDataProvider')]
    public function testFromMethodCreatesDtoWhenRequiredFieldsArePresent(
        ?string $title,
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
            actual: $dto->user->uuid,
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title->value(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description?->value(),
        );
    }

    public static function validInputDataProvider(): array
    {
        return [
            'all parameters' => [
                'title'       => 'title',
                'description' => 'description',
            ],
            'null description' => [
                'title'       => 'title',
                'description' => null,
            ],
        ];
    }

    #[DataProvider('invalidInputDataProvider')]
    public function testFromMethodThrowsAnExceptionWhenRequiredFieldsAreMissing(
        ?string $title,
        ?string $description,
    ): void {
        $user = $this->user();

        $this->expectException(
            RequiredValueIsNotPresentException::class,
        );

        CreateProjectDto::from([
            'user'        => $user,
            'title'       => $title,
            'description' => $description,
        ]);
    }

    public static function invalidInputDataProvider(): array
    {
        return [
            'title is null' => [
                'title'       => null,
                'description' => null,
            ],
        ];
    }
}
