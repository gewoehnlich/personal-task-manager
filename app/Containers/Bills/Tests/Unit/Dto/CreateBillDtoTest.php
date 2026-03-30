<?php

namespace App\Containers\Bills\Tests\Unit\Dto;

use App\Containers\Bills\Dto\CreateBillDto;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(CreateBillDto::class)]
#[Small]
final class CreateBillDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithAllParameters(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $description = 'description';

        $minutesSpent = 60;

        $performedAt = new PerformedAtValue(
            carbon: Carbon::now()
                ->subDay(),
        );

        $dto = CreateBillDto::from([
            'task_uuid'     => $task->uuid,
            'description'   => $description,
            'minutes_spent' => $minutesSpent,
            'performed_at'  => $performedAt->value(),
        ]);

        $this->assertEquals(
            expected: $task->uuid,
            actual: $dto->taskUuid(),
        );

        $this->assertEquals(
            expected: $description,
            actual: $dto->description(),
        );

        $this->assertEquals(
            expected: $minutesSpent,
            actual: $dto->minutesSpent(),
        );

        $this->assertEquals(
            expected: $performedAt->value(),
            actual: $dto->performedAt(),
        );
    }

    public function testFromMethodCreatesDtoWithNullableParametersBeingNull(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $dto = CreateBillDto::from([
            'task_uuid'     => $task->uuid,
            'description'   => null,
            'minutes_spent' => null,
            'performed_at'  => null,
        ]);

        $this->assertEquals(
            expected: $task->uuid,
            actual: $dto->taskUuid(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->description(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->minutesSpent(),
        );

        $this->assertEquals(
            expected: null,
            actual: $dto->performedAt(),
        );
    }

    #[DataProvider('invalidInputDataProvider')]
    public function testFromMethodShouldThrowAnExceptionWhenRequiredFieldIsNotPresent(
        ?string $taskUuid,
    ): void {
        $this->expectException(
            RequiredValueIsNotPresentException::class,
        );

        CreateBillDto::from([
            'task_uuid'     => $taskUuid,
            'description'   => null,
            'minutes_spent' => null,
            'performed_at'  => null,
        ]);
    }

    public static function invalidInputDataProvider(): array
    {
        return [
            'task is null' => [
                'taskUuid' => null,
            ],
        ];
    }
}
