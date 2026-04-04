<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Enums\OrderByEnum;
use App\Containers\Projects\Enums\OrderByFieldEnum;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(IndexProjectsDto::class)]
#[Small]
final class IndexProjectsDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $title = 'title';

        $description = 'description';

        $deleted = DeletedEnum::ONLY;

        $createdAtFrom = $this->datetimeString();

        $createdAtTo = $this->datetimeString();

        $updatedAtFrom = $this->datetimeString();

        $updatedAtTo = $this->datetimeString();

        $deletedAtFrom = $this->datetimeString();

        $deletedAtTo = $this->datetimeString();

        $orderBy = OrderByEnum::ASC;

        $orderByField = OrderByFieldEnum::CREATED_AT;

        $limit = 2;

        $dto = IndexProjectsDto::from([
            'user'            => $user,
            'uuid'            => $project->uuid,
            'title'           => $title,
            'description'     => $description,
            'deleted'         => $deleted->value,
            'created_at_from' => $createdAtFrom,
            'created_at_to'   => $createdAtTo,
            'updated_at_from' => $updatedAtFrom,
            'updated_at_to'   => $updatedAtTo,
            'deleted_at_from' => $deletedAtFrom,
            'deleted_at_to'   => $deletedAtTo,
            'order_by'        => $orderBy->value,
            'order_by_field'  => $orderByField->value,
            'limit'           => $limit,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->project?->uuid,
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title?->value(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description?->value(),
        );

        $this->assertSame(
            expected: $deleted,
            actual: $dto->deleted,
        );

        $this->assertSame(
            expected: $createdAtFrom,
            actual: $dto->createdAtFrom?->value(),
        );

        $this->assertSame(
            expected: $createdAtTo,
            actual: $dto->createdAtTo?->value(),
        );

        $this->assertSame(
            expected: $updatedAtFrom,
            actual: $dto->updatedAtFrom?->value(),
        );

        $this->assertSame(
            expected: $updatedAtTo,
            actual: $dto->updatedAtTo?->value(),
        );

        $this->assertSame(
            expected: $deletedAtFrom,
            actual: $dto->deletedAtFrom?->value(),
        );

        $this->assertSame(
            expected: $deletedAtTo,
            actual: $dto->deletedAtTo?->value(),
        );

        $this->assertSame(
            expected: $orderBy,
            actual: $dto->orderBy,
        );

        $this->assertSame(
            expected: $orderByField,
            actual: $dto->orderByField,
        );

        $this->assertSame(
            expected: $limit,
            actual: $dto->limit,
        );
    }

    public function testFromMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $dto = IndexProjectsDto::from([
            'user'            => $user,
            'uuid'            => null,
            'title'           => null,
            'description'     => null,
            'deleted'         => null,
            'created_at_from' => null,
            'created_at_to'   => null,
            'updated_at_from' => null,
            'updated_at_to'   => null,
            'deleted_at_from' => null,
            'deleted_at_to'   => null,
            'order_by'        => null,
            'order_by_field'  => null,
            'limit'           => null,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
        );
    }
}
