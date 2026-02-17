<?php

namespace App\Containers\Projects\Tests\Unit\Values;

use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Values\ProjectUuidValue;
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
#[CoversClass(ProjectUuidValue::class)]
#[Small]
final class ProjectUuidValueTest extends TestCase
{
    #[TestDox('project uuid should be creatable with valid uuid string format and existing project')]
    public function testValidUuidAndExistingProject(): void
    {
        $project = Project::factory()
            ->for(factory: User::factory()->create())
            ->create();

        $value = new ProjectUuidValue(
            uuid: $project->uuid,
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $value->uuid,
            message: 'the uuid should be the same',
        );
    }

    #[TestDox('project uuid should not be creatable with valid uuid string format and nonexistent project')]
    public function testValidUuidAndNonexistentProject(): void
    {
        $uuid = Str::uuid7(time: Carbon::now());

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        new ProjectUuidValue(
            uuid: $uuid,
        );
    }

    #[TestDox('project uuid should not be creatable with invalid uuid and, hence, nonexistent project')]
    public function testInvalidUuid(): void
    {
        $uuid = 'invalid uuid';

        $this->expectException(
            exception: NotValidUuidException::class,
        );

        new ProjectUuidValue(
            uuid: $uuid,
        );
    }
}
