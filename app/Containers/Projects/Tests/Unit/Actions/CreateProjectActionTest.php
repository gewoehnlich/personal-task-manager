<?php

namespace App\Containers\Projects\Tests\Unit\Actions;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Parents\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(CreateProjectAction::class)]
#[Medium]
#[UsesClass(CreateProjectTransporter::class)]
final class CreateProjectActionTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('action creates a project')]
    public function testAction(
        string $name,
        ?string $description,
    ): void {
        $user = User::factory()->create();

        $this->assertFalse(
            condition: $user->projects()->exists(),
            message: 'test user should not have created projects',
        );

        $transporter = new CreateProjectTransporter(
            userUuid: $user->uuid,
            name: $name,
            description: $description,
        );

        $response = $this->action(
            CreateProjectAction::class,
            $transporter,
        );

        $projectUuid = $response->data['uuid'];

        $this->assertDatabaseHas('projects', [
            'uuid'        => $projectUuid,
            'user_uuid'   => $user->uuid,
            'name'        => $name,
            'description' => $description,
        ]);

        $this->assertTrue(
            $user->projects()->exists(),
            'the project was not created for test user',
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                'name',        // name
                'description', // description
            ],
            'null description' => [
                'name', // name
                null,   // description
            ],
        ];
    }
}
