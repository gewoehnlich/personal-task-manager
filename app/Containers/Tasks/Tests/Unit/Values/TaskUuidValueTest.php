<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Values\TaskUuidValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\NotValidUuidException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(TaskUuidValue::class)]
#[Small]
final class TaskUuidValueTest extends TestCase
{
    #[TestDox('task uuid should be creatable with valid uuid string format and existing task')]
    public function testValidUuidAndExistingTask(): void
    {
        $task = Task::factory()
            ->for(factory: User::factory()->create())
            ->create();

        $value = new TaskUuidValue(
            uuid: $task->uuid,
        );

        $this->assertSame(
            expected: $task->uuid,
            actual: $value->uuid,
            message: 'the uuid is not the same',
        );
    }

    #[TestDox('task uuid should not be creatable with valid uuid string format and nonexistent task')]
    public function testValidUuidAndNonexistentTask(): void
    {
        $uuid = Str::uuid7(time: Carbon::now());

        $this->expectException(
            exception: TaskWithThisUuidDoesNotExistException::class,
        );

        new TaskUuidValue(
            uuid: $uuid,
        );
    }

    #[TestDox('task uuid should not be creatable with invalid uuid and, hence, nonexistent task')]
    public function testInvalidUuid(): void
    {
        $uuid = 'invalid uuid';

        $this->expectException(
            exception: NotValidUuidException::class,
        );

        new TaskUuidValue(
            uuid: $uuid,
        );
    }
}
