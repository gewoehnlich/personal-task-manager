<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\DeletedEnum;
use App\Containers\Tasks\Enums\OrderByEnum;
use App\Containers\Tasks\Enums\OrderByFieldEnum;
use App\Containers\Tasks\Enums\StageEnum;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(IndexTasksDto::class)]
#[Small]
final class IndexTasksDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $task = $this->task(
            user: $user,
            project: $project,
        );

        $title = 'title';

        $description = 'description';

        $stage = StageEnum::PENDING;

        $createdAtFrom = $this->datetimeString();

        $createdAtTo = $this->datetimeString();

        $updatedAtFrom = $this->datetimeString();

        $updatedAtTo = $this->datetimeString();

        $deletedAtFrom = $this->datetimeString();

        $deletedAtTo = $this->datetimeString();

        $deadlineFrom = $this->datetimeString();

        $deadlineTo = $this->datetimeString();

        $orderBy = OrderByEnum::ASC->value;

        $orderByField = OrderByFieldEnum::CREATED_AT->value;

        $deleted = DeletedEnum::ONLY;

        $limit = 2;

        $dto = IndexTasksDto::from([
            'user'            => $user,
            'uuid'            => $task->uuid,
            'title'           => $title,
            'project_uuid'    => $project->uuid,
            'description'     => $description,
            'stage'           => $stage->value,
            'created_at_from' => $createdAtFrom,
            'created_at_to'   => $createdAtTo,
            'updated_at_from' => $updatedAtFrom,
            'updated_at_to'   => $updatedAtTo,
            'deleted_at_from' => $deletedAtFrom,
            'deleted_at_to'   => $deletedAtTo,
            'deadline_from'   => $deadlineFrom,
            'deadline_to'     => $deadlineTo,
            'order_by'        => $orderBy,
            'order_by_field'  => $orderByField,
            'deleted'         => $deleted->value,
            'limit'           => $limit,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->userUuid(),
        );

        $this->assertSame(
            expected: $task->uuid,
            actual: $dto->taskUuid(),
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title(),
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->projectUuid(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description(),
        );

        $this->assertSame(
            expected: $stage->value,
            actual: $dto->stage(),
        );

        $this->assertSame(
            expected: $createdAtFrom,
            actual: $dto->createdAtFrom(),
        );

        $this->assertSame(
            expected: $createdAtTo,
            actual: $dto->createdAtTo(),
        );

        $this->assertSame(
            expected: $updatedAtFrom,
            actual: $dto->updatedAtFrom(),
        );

        $this->assertSame(
            expected: $updatedAtTo,
            actual: $dto->updatedAtTo(),
        );

        $this->assertSame(
            expected: $deletedAtFrom,
            actual: $dto->deletedAtFrom(),
        );

        $this->assertSame(
            expected: $deletedAtTo,
            actual: $dto->deletedAtTo(),
        );

        $this->assertSame(
            expected: $deadlineFrom,
            actual: $dto->deadlineFrom(),
        );

        $this->assertSame(
            expected: $deadlineTo,
            actual: $dto->deadlineTo(),
        );

        $this->assertSame(
            expected: $orderBy,
            actual: $dto->orderBy(),
        );

        $this->assertSame(
            expected: $orderByField,
            actual: $dto->orderByField(),
        );

        $this->assertSame(
            expected: $deleted,
            actual: $dto->deleted(),
        );

        $this->assertSame(
            expected: $limit,
            actual: $dto->limit(),
        );
    }

    public function testFromMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $dto = IndexTasksDto::from([
            'user'            => $user,
            'uuid'            => null,
            'title'           => null,
            'description'     => null,
            'stage'           => null,
            'project_uuid'    => null,
            'created_at_from' => null,
            'created_at_to'   => null,
            'updated_at_from' => null,
            'updated_at_to'   => null,
            'deleted_at_from' => null,
            'deleted_at_to'   => null,
            'deadline_from'   => null,
            'deadline_to'     => null,
            'order_by'        => null,
            'order_by_field'  => null,
            'deleted'         => null,
            'limit'           => null,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->userUuid(),
            message: 'dto user should be the same as expected',
        );
    }
}
