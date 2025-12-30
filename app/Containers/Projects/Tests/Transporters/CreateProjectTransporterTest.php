<?php

namespace App\Containers\Projects\Tests\Transporters;

use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Ship\Parents\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class CreateProjectTransporterTest extends TestCase
{
    private const array PARAMETERS = ['user_uuid', 'name', 'description'];

    #[DataProvider('data')]
    #[TestDox('SnakeCaseMapper resolves parameters from camelCase to snake_case in toArray() method')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $userUuid,
        string $name,
        ?string $description,
    ): void {
        $transporter = new CreateProjectTransporter(
            userUuid: $userUuid,
            name: $name,
            description: $description,
        );

        $this->assertSame(
            expected: [
                'user_uuid'   => $userUuid,
                'name'        => $name,
                'description' => $description,
            ],
            actual: $transporter->toArray(),
        );

        $this->assertSame(
            expected: self::PARAMETERS,
            actual: array_keys(
                array: $transporter->toArray(),
            ),
        );
    }

    public static function data(): array
    {
        return [
            'string description' => ['019b6eb2-ef9a-70b8-999e-e6835a07e4d2', 'name', 'description'],
            'null description'   => ['019b6eb2-ef9a-70b8-999e-e6835a07e4d2', 'name', null],
        ];
    }
}
