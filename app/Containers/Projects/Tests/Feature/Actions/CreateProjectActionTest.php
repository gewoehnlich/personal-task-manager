<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
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
#[UsesClass(CreateProjectDto::class)]
final class CreateProjectActionTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('action creates a project')]
    public function testAction(
        string $title,
        ?string $description,
    ): void {
        $user = User::factory()->create();

        $response = $this->action(
            class: CreateProjectAction::class,
            dto: CreateProjectDto::from([
                'user_uuid'   => $user->uuid,
                'title'       => $title,
                'description' => $description,
            ]),
        );

        $this->assertDatabaseHas(
            table: 'projects',
            data: [
                'uuid'        => $response->data->uuid,
                'user_uuid'   => $user->uuid,
                'title'       => $title,
                'description' => $description,
            ],
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
