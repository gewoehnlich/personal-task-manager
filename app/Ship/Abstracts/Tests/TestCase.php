<?php

namespace App\Ship\Abstracts\Tests;

use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Projects\Values\CreatedAtValue;
use App\Containers\Projects\Values\DeletedAtValue;
use App\Containers\Projects\Values\UpdatedAtValue;
use App\Containers\Users\Models\User;
use App\Ship\Traits\CanCallActionTrait;
use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;
use Database\Seeders\TestSeeder;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    protected readonly ProjectRepository $projectRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestSeeder::class);

        $this->projectRepository = app(ProjectRepository::class);
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
        User $user,
        ?CreatedAtValue $createdAt = null,
        ?UpdatedAtValue $updatedAt = null,
        ?DeletedAtValue $deletedAt = null,
    ): Project {
        $data = [
            'user_uuid' => $user->uuid,
        ];

        if ($createdAt) {
            $data['created_at'] = $createdAt->value();
        }

        if ($updatedAt) {
            $data['updated_at'] = $updatedAt->value();
        }

        if ($deletedAt) {
            $data['deleted_at'] = $deletedAt->value();
        }

        return Project::factory()
            ->create($data);
    }

    public function request(
        string $class,
        string $routeName,
        string $method,
        array $parameters,
        User $user,
        ?array $routeParameters = null,
    ): Request {
        $request = $class::create(
            uri: $routeName,
            method: $method,
            parameters: $parameters,
        );

        $request->setContainer(app());
        $request->setRedirector(app('redirect'));

        if ($routeParameters !== null) {
            $route = app('router')->getRoutes()->getByName($routeName);
            $route->bind($request);

            foreach ($routeParameters as $key => $value) {
                $route->setParameter($key, $value);
            }

            $request->setRouteResolver(fn () => $route);
        }

        $request->setUserResolver(fn () => $user);

        return $request;
    }

    public function datetimeString(): string
    {
        return Carbon::now()->toAtomString();
    }
}
