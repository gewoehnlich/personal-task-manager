<?php

namespace App\Containers\Bills\Tests\Unit\Dto;

use App\Containers\Bills\Dto\UpdateBillDto;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(UpdateBillDto::class)]
#[Small]
final class UpdateBillDtoTest extends TestCase
{
    public function testFromMethodUpdatesDtoWithAllParameters(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $description = 'description';

        $minutesSpent = 60;

        $performedAt = new PerformedAtValue(
            carbon: Carbon::now()
                ->subDay(),
        );

        $dto = UpdateBillDto::from([
            'uuid'          => $bill->uuid,
            'task_uuid'     => $task->uuid,
            'description'   => $description,
            'minutes_spent' => $minutesSpent,
            'performed_at'  => $performedAt->value(),
        ]);

        $this->assertEquals(
            expected: $bill->uuid,
            actual: $dto->bill()->uuid,
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

    public function testFromMethodUpdatesDtoWithNullableParametersBeingNull(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $dto = UpdateBillDto::from([
            'uuid'          => $bill->uuid,
            'task_uuid'     => $task->uuid,
            'description'   => null,
            'minutes_spent' => null,
            'performed_at'  => null,
        ]);

        $this->assertEquals(
            expected: $bill->uuid,
            actual: $dto->bill()->uuid,
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
        ?string $billUuid,
        ?string $taskUuid,
    ): void {
        $this->expectException(
            RequiredValueIsNotPresentException::class,
        );

        UpdateBillDto::from([
            'uuid'          => $billUuid,
            'task_uuid'     => $taskUuid,
            'description'   => null,
            'minutes_spent' => null,
            'performed_at'  => null,
        ]);
    }

    public static function invalidInputDataProvider(): array
    {
        return [
            'bill is null' => [
                'billUuid' => null,
                'taskUuid' => Str::uuid()->toString(),
            ],
            'task is null' => [
                'billUuid' => Str::uuid()->toString(),
                'taskUuid' => null,
            ],
        ];
    }
}
