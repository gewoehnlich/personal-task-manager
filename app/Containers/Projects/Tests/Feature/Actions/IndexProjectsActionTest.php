<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Enums\OrderByEnum;
use App\Containers\Projects\Enums\OrderByFieldEnum;
use App\Containers\Projects\Values\CreatedAtValue;
use App\Containers\Projects\Values\DeletedAtValue;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Projects\Values\UpdatedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(IndexProjectsAction::class)]
#[Medium]
final class IndexProjectsActionTest extends TestCase
{
    public function testActionReturnsProjectsThatBelongToAuthenticatedUser(): void
    {
        $user1 = $this->user();

        $project1 = $this->project(
            user: $user1,
        );

        $project2 = $this->project(
            user: $user1,
        );

        $user2 = $this->user();

        $project3 = $this->project(
            user: $user2,
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user1,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because there are 2 projects created for this user',
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project1->uuid)->first(),
            message: 'there should be a project with this uuid in the result',
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project2->uuid)->first(),
            message: 'there should be a project with this uuid in the result',
        );

        $this->assertNull(
            actual: $result->where('uuid', $project3->uuid)->first(),
            message: 'there should be this project because it belongs to another user',
        );
    }

    public function testActionFiltersProjectsByUuid(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $this->project(
            user: $user,
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                project: $project,
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by uuid',
        );

        $this->assertEquals(
            expected: $project->uuid,
            actual: $result->first()->uuid,
        );
    }

    public function testActionFiltersProjectsByTitle(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $this->project(
            user: $user,
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                title: new TitleValue(
                    string: $project->title,
                ),
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by title',
        );

        $this->assertEquals(
            expected: $project->title,
            actual: $result->first()->title,
        );
    }

    public function testActionFiltersProjectsByDescription(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $this->project(
            user: $user,
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                description: new DescriptionValue(
                    string: $project->description,
                ),
            ),
        );

        $this->assertCount(
            expectedCount: 1,
            haystack: $result,
            message: 'the expectedCount should be 1, because action should filter by description',
        );

        $this->assertEquals(
            expected: $project->description,
            actual: $result->first()->description,
        );
    }

    public function testActionFiltersProjectsByCreatedAtFrom(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $createdAtFrom = new CreatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            createdAt: $createdAtFrom,
        );

        $this->project(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                createdAtFrom: $createdAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionFiltersProjectsByCreatedAtTo(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $createdAtTo = new CreatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            createdAt: $createdAtTo,
        );

        $this->project(
            user: $user,
            createdAt: new CreatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                createdAtTo: $createdAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionFiltersProjectsByUpdatedAtFrom(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $updatedAtFrom = new UpdatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            updatedAt: $updatedAtFrom,
        );

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                updatedAtFrom: $updatedAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionFiltersProjectsByUpdatedAtTo(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $updatedAtTo = new UpdatedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            updatedAt: $updatedAtTo,
        );

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                updatedAtTo: $updatedAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionFiltersProjectsByDeletedAtFrom(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deletedAtFrom = new DeletedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            deletedAt: $deletedAtFrom,
        );

        $this->project(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                deleted: DeletedEnum::WITH,
                deletedAtFrom: $deletedAtFrom,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionFiltersProjectsByDeletedAtTo(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now()->subDays(2),
            ),
        );

        $deletedAtTo = new DeletedAtValue(
            carbon: Carbon::now()->subDays(1),
        );

        $this->project(
            user: $user,
            deletedAt: $deletedAtTo,
        );

        $this->project(
            user: $user,
            deletedAt: new DeletedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
                user: $user,
                deleted: DeletedEnum::WITH,
                deletedAtTo: $deletedAtTo,
            ),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: 'the expectedCount should be 2, because action should filter out 2 projects',
        );
    }

    public function testActionSortsProjects(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now()->subDays(1),
            ),
        );

        $this->project(
            user: $user,
            updatedAt: new UpdatedAtValue(
                carbon: Carbon::now(),
            ),
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
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

    public function testActionFiltersProjectsByLimit(): void
    {
        $user = $this->user();

        $this->project(
            user: $user,
        );

        $this->project(
            user: $user,
        );

        $limit = 1;

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: new IndexProjectsDto(
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
