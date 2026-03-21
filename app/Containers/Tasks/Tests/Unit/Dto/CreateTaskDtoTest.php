<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Containers\Tasks\Values\StageValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(CreateTaskDto::class)]
#[Small]
final class CreateTaskDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithAllParameters(): void
    {
        $user = $this->user();

        $title = 'title';

        $stage = new StageValue(
            stage: Stage::PENDING,
        );

        $description = 'description';

        $deadline = new DeadlineValue(
            carbon: Carbon::now()
                ->addDay(),
        );

        $project = Project::factory()
            ->for($user)
            ->create();

        $dto = CreateTaskDto::from([
            'user' => $user,
            'title' => $title,
            'stage' => $stage->value(),
            'description' => $description,
            'deadline' => $deadline->value(),
            'project_uuid' => $project->uuid,
        ]);

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->userUuid(),
        );

        $this->assertEquals(
            expected: $title,
            actual: $dto->title(),
        );

        $this->assertEquals(
            expected: $stage->value(),
            actual: $dto->stage(),
        );

        $this->assertEquals(
            expected: $description,
            actual: $dto->description(),
        );

        $this->assertEquals(
            expected: $deadline->value(),
            actual: $dto->deadline(),
        );

        $this->assertEquals(
            expected: $project->uuid,
            actual: $dto->projectUuid(),
        );
    }

    public function testFromMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $user = $this->user();

        $title = 'title';

        $stage = new StageValue(
            stage: Stage::PENDING,
        );

        $dto = CreateTaskDto::from([
            'user' => $user,
            'title' => $title,
            'stage' => $stage->value(),
            'description' => null,
            'deadline' => null,
            'project_uuid' => null,
        ]);

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->userUuid(),
        );

        $this->assertEquals(
            expected: $title,
            actual: $dto->title(),
        );

        $this->assertEquals(
            expected: $stage->value(),
            actual: $dto->stage(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->description(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->deadline(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->projectUuid(),
        );
    }

    #[DataProvider('invalidInputDataProvider')]
    public function testFromMethodShouldThrowAnExceptionWhenRequiredFieldIsNotPresent(
        ?string $title,
        ?StageValue $stage,
    ): void {
        $user = $this->user();

        $this->expectException(
            RequiredValueIsNotPresentException::class,
        );

        CreateTaskDto::from([
            'user' => $user,
            'title' => $title,
            'stage' => $stage,
            'description' => null,
            'deadline' => null,
            'project_uuid' => null,
        ]);
    }

    public static function invalidInputDataProvider(): array
    {
        return [
            'title is null' => [
                'title' => null,
                'stage' => new StageValue(
                    stage: Stage::PENDING,
                ),
            ],
            'stage is null' => [
                'title' => 'title',
                'stage' => null,
            ],
        ];
    }
}
