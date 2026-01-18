<?php

namespace App\Containers\Users\Tests\Unit\Values;

use App\Containers\Users\Exceptions\UserWithThisUuidDoesNotExistException;
use App\Containers\Users\Models\User;
use App\Containers\Users\Values\UserUuidValue;
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
#[CoversClass(UserUuidValue::class)]
#[Small]
final class UserUuidValueTest extends TestCase
{
    #[TestDox('user uuid value should be creatable with valid uuid string format and existing user')]
    public function testValidUuidAndExistingUser(): void
    {
        $user = User::factory()
            ->create();

        $value = new UserUuidValue(
            uuid: $user->uuid,
        );

        $this->assertSame(
            expected: $user->uuid,
            actual: $value->uuid,
            message: 'the uuid is not the same',
        );
    }

    #[TestDox('user uuid value should not be creatable with valid uuid string format and nonexistent user')]
    public function testValidUuidAndNonexistentProject(): void
    {
        $uuid = Str::uuid7(time: Carbon::now());

        $this->expectException(
            exception: UserWithThisUuidDoesNotExistException::class,
        );

        new UserUuidValue(
            uuid: $uuid,
        );
    }

    #[TestDox('user uuid value should not be creatable with invalid uuid and, hence, nonexistent user')]
    public function testInvalidUuid(): void
    {
        $uuid = 'invalid uuid';

        $this->expectException(
            exception: NotValidUuidException::class,
        );

        new UserUuidValue(
            uuid: $uuid,
        );
    }
}
