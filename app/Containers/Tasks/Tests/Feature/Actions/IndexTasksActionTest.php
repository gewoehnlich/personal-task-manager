<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\DeletedEnum;
use App\Containers\Tasks\Enums\OrderByEnum;
use App\Containers\Tasks\Enums\OrderByFieldEnum;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Containers\Tasks\Values\StageValue;
use App\Containers\Tasks\Values\TitleValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Values\CreatedAtValue;
use App\Ship\Values\DeletedAtValue;
use App\Ship\Values\UpdatedAtValue;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(IndexTasksAction::class)]
#[Medium]
#[UsesClass(IndexTasksDto::class)]
final class IndexTasksActionTest extends TestCase
{
    public function testActionReturnsTasksThatBelongToAuthenticatedUser(): void
    {
        $user1 = $this->user();

        $task1 = $this->task(
            user: $user1,
        );

        $task2 = $this->task(
            user: $user1,
        );

        $user2 = $this->user();

        $task3 = $this->task(
            user: $user2,
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user1,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $task1->uuid)->first(),
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $task2->uuid)->first(),
        );

        $this->assertNull(
            actual: $result->where('uuid', $task3->uuid)->first(),
        );
    }

    public function testActionFiltersTasksByUuid(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $this->task(
            user: $user,
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                task: $task,
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by uuid',
        );

        $this->assertEquals(
            expected: $task->uuid,
            actual: $result->first()->uuid,
        );
    }

    public function testActionFiltersTasksByTitle(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $this->task(
            user: $user,
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                title: new TitleValue(
                    string: $task->title,
                ),
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by title',
        );

        $this->assertEquals(
            expected: $task->title,
            actual: $result->first()->title,
        );
    }

    public function testActionFiltersTasksByDescription(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $this->task(
            user: $user,
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                description: new DescriptionValue(
                    string: $task->description,
                ),
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by description',
        );

        $this->assertEquals(
            expected: $task->description,
            actual: $result->first()->description,
        );
    }

    public function testActionFiltersTasksByStage(): void
    {
        $user = $this->user();

        $stage = StageEnum::DONE;

        $task = $this->task(
            user: $user,
            stage: $stage,
        );

        $this->task(
            user: $user,
            stage: StageEnum::PENDING,
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                stage: new StageValue(
                    stage: $stage,
                ),
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by stage',
        );

        $this->assertEquals(
            expected: $task->stage,
            actual: $result->first()->stage,
        );
    }

    public function testActionFiltersTasksByProjectUuid(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $task = $this->task(
            user: $user,
            project: $project,
        );

        $this->task(
            user: $user,
            project: $this->project(
                user: $user,
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                project: $project,
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by project uuid',
        );

        $this->assertEquals(
            expected: $task->project_uuid,
            actual: $result->first()->project_uuid,
        );
    }

    public function testActionFiltersTasksByCreatedAtFrom(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $createdAtFrom = new CreatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            createdAt: $createdAtFrom,
        );

        $this->task(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                createdAtFrom: $createdAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByCreatedAtTo(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $createdAtTo = new CreatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            createdAt: $createdAtTo,
        );

        $this->task(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                createdAtTo: $createdAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByUpdatedAtFrom(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $updatedAtFrom = new UpdatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            updatedAt: $updatedAtFrom,
        );

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                updatedAtFrom: $updatedAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByUpdatedAtTo(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $updatedAtTo = new UpdatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            updatedAt: $updatedAtTo,
        );

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                updatedAtTo: $updatedAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByDeletedAtFrom(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deletedAtFrom = new DeletedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            deletedAt: $deletedAtFrom,
        );

        $this->task(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                deleted: DeletedEnum::WITH,
                deletedAtFrom: $deletedAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByDeletedAtTo(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deletedAtTo = new DeletedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            deletedAt: $deletedAtTo,
        );

        $this->task(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                deleted: DeletedEnum::WITH,
                deletedAtTo: $deletedAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByDeadlineFrom(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            deadline: new DeadlineValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deadlineFrom = new DeadlineValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            deadline: $deadlineFrom,
        );

        $this->task(
            user: $user,
            deadline: new DeadlineValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                deadlineFrom: $deadlineFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionFiltersTasksByDeadlineTo(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            deadline: new DeadlineValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deadlineTo = new DeadlineValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->task(
            user: $user,
            deadline: $deadlineTo,
        );

        $this->task(
            user: $user,
            deadline: new DeadlineValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                deadlineTo: $deadlineTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 tasks',
        );
    }

    public function testActionSortsTasks(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(1),
            ),
        );

        $this->task(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                orderBy: OrderByEnum::DESC,
                orderByField: OrderByFieldEnum::UPDATED_AT,
            ),
        );

        $this->assertTrue(
            condition: $result->first()->updated_at > $result->last()->updated_at,
            message: 'result has to be sorted desc by updated_at',
        );
    }

    public function testActionFiltersTasksByLimit(): void
    {
        $user = $this->user();

        $this->task(
            user: $user,
        );

        $this->task(
            user: $user,
        );

        $limit = 1;

        $result = $this->action(
            class: IndexTasksAction::class,
            dto: new IndexTasksDto(
                user: $user,
                limit: $limit,
            ),
        );

        $this->assertCount(
            expectedCount: $limit,
            haystack: $result,
        );
    }
}
