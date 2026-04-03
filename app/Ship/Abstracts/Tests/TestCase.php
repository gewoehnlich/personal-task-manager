<?php

namespace App\Ship\Abstracts\Tests;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Repositories\BillRepository;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Users\Models\User;
use App\Ship\Traits\CanCallActionTrait;
use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;
use App\Ship\Values\CreatedAtValue;
use App\Ship\Values\DeletedAtValue;
use App\Ship\Values\UpdatedAtValue;
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

    protected readonly TaskRepository $taskRepository;

    protected readonly BillRepository $billRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestSeeder::class);

        $this->projectRepository = app(ProjectRepository::class);

        $this->taskRepository = app(TaskRepository::class);

        $this->billRepository = app(BillRepository::class);
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

    public function task(
        User $user,
        ?Project $project = null,
        ?CreatedAtValue $createdAt = null,
        ?UpdatedAtValue $updatedAt = null,
        ?DeletedAtValue $deletedAt = null,
        ?DeadlineValue $deadline = null,
        ?StageEnum $stage = null,
    ): Task {
        $data = [
            'user_uuid' => $user->uuid,
        ];

        if ($project) {
            $data['project_uuid'] = $project->uuid;
        }

        if ($createdAt) {
            $data['created_at'] = $createdAt->value();
        }

        if ($updatedAt) {
            $data['updated_at'] = $updatedAt->value();
        }

        if ($deletedAt) {
            $data['deleted_at'] = $deletedAt->value();
        }

        if ($deadline) {
            $data['deadline'] = $deadline->value();
        }

        if ($stage) {
            $data['stage'] = $stage->value;
        }

        return Task::factory()
            ->create($data);
    }

    public function bill(
        Task $task,
        ?PerformedAtValue $performedAt = null,
    ): Bill {
        $data = [
            'task_uuid' => $task->uuid,
        ];

        if ($performedAt) {
            $data['performed_at'] = $performedAt->value();
        }

        return Bill::factory()
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
