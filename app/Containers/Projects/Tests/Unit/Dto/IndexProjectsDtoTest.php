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
    public function testFromMethodWithNullableParametersBeingNullCreatesTheDto(): void
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
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->user->uuid,
            message: 'dto user should be the same as expected',
        );
    }

    public function testFromMethodWithAllParametersFilledShouldCreateTheDto(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $title = 'title';

        $description = 'description';

        $deleted = DeletedEnum::ONLY->value;

        $createdAtFrom = $this->datetimeString();

        $createdAtTo = $this->datetimeString();

        $updatedAtFrom = $this->datetimeString();

        $updatedAtTo = $this->datetimeString();

        $deletedAtFrom = $this->datetimeString();

        $deletedAtTo = $this->datetimeString();

        $orderBy = OrderByEnum::ASC->value;

        $orderByField = OrderByFieldEnum::CREATED_AT->value;

        $dto = IndexProjectsDto::from([
            'user'            => $user,
            'uuid'            => $project->uuid,
            'title'           => $title,
            'description'     => $description,
            'deleted'         => $deleted,
            'created_at_from' => $createdAtFrom,
            'created_at_to'   => $createdAtTo,
            'updated_at_from' => $updatedAtFrom,
            'updated_at_to'   => $updatedAtTo,
            'deleted_at_from' => $deletedAtFrom,
            'deleted_at_to'   => $deletedAtTo,
            'order_by'        => $orderBy,
            'order_by_field'  => $orderByField,
        ]);

        $this->assertSame(
            expected: $user->uuid,
            actual: $dto->userUuid(),
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->projectUuid(),
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description(),
        );

        $this->assertSame(
            expected: $deleted,
            actual: $dto->deleted(),
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
            expected: $orderBy,
            actual: $dto->orderBy(),
        );

        $this->assertSame(
            expected: $orderByField,
            actual: $dto->orderByField(),
        );
    }
}
