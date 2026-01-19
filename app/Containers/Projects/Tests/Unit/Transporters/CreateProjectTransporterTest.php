<?php

namespace App\Containers\Projects\Tests\Unit\Transporters;

use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(CreateProjectTransporter::class)]
#[Small]
final class CreateProjectTransporterTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('transporter should be creatable with from() method')]
    public function testFromMethodTransporterCreation(
        string $title,
        ?string $description,
    ): void {
        $userUuid = User::factory()
            ->create()
            ->uuid;

        $transporter = CreateProjectTransporter::from([
            'user_uuid'   => $userUuid,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: $userUuid,
            actual: $transporter->userUuid->uuid,
            message: 'userUuid differs',
        );

        $this->assertSame(
            expected: $title,
            actual: $transporter->title->string,
            message: 'title differs',
        );

        $this->assertSame(
            expected: $description,
            actual: $transporter->description?->string,
            message: 'description differs',
        );
    }

    #[DataProvider('data')]
    #[TestDox('transporter should be convertable to array with toArray() method')]
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

        $transporter = CreateProjectTransporter::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $transporter->toArray(),
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
