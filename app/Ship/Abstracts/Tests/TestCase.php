<?php

namespace App\Ship\Abstracts\Tests;

use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Traits\CanCallActionTrait;
use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;
use Database\Seeders\TestSeeder;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    use CanCallActionTrait;
    use CanCallCommandTrait;
    use CanCallSubactionTrait;
    use CanCallTaskTrait;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestSeeder::class);
    }

    public function user(): User
    {
        /** @var Authenticatable $user */
        $user = User::factory()
            ->create();

        $this->actingAs(
            user: $user,
        );

        return $user;
    }

    public function project(
        ?User $user = null,
    ): Project {
        return Project::factory()
            ->create([
                'user_uuid' => $user?->uuid,
            ]);
    }
}
