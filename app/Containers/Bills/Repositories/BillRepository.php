<?php

namespace App\Containers\Bills\Repositories;

use App\Containers\Bills\Exceptions\BillDoesNotBelongToThisTaskException;
use App\Containers\Bills\Exceptions\BillWithThisUuidDoesNotExistException;
use App\Containers\Bills\Models\Bill;
use App\Ship\Abstracts\Repositories\Repository;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;

final readonly class BillRepository extends Repository
{
    public static function byUuid(
        ?string $uuid,
        ?string $taskUuid,
    ): Bill {
        if ($uuid === null) {
            throw new RequiredValueIsNotPresentException(
                entity: 'uuid',
            );
        }

        if ($taskUuid === null) {
            throw new RequiredValueIsNotPresentException(
                entity: 'taskUuid',
            );
        }

        /** @var Bill|null $bill */
        $bill = Bill::query()
            ->withTrashed()
            ->with('task')
            ->where('uuid', $uuid)
            ->first();

        if ($bill === null) {
            throw new BillWithThisUuidDoesNotExistException(
                uuid: $uuid,
            );
        }

        if ($bill->task->uuid !== $taskUuid) {
            throw new BillDoesNotBelongToThisTaskException(
                uuid: $uuid,
                taskUuid: $taskUuid,
            );
        }

        return $bill;
    }

    public static function byNullableUuid(
        ?string $uuid,
        ?string $taskUuid,
    ): ?Bill {
        if ($uuid === null) {
            return null;
        }

        return self::byUuid(
            uuid: $uuid,
            taskUuid: $taskUuid,
        );
    }
}
