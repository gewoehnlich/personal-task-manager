<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\IndexBillsDto;
use App\Containers\Bills\Enums\DeletedEnum;
use App\Containers\Bills\Models\Bill;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Support\Collection;

final readonly class IndexBillsAction extends Action
{
    public function run(
        IndexBillsDto $dto,
    ): Collection {
        $query = Bill::query();

        $query = $query->where('user_uuid', $dto->user->uuid);

        if ($dto->bill) {
            $query = $query->where('uuid', $dto->bill->uuid);
        }

        if ($dto->task) {
            $query = $query->where('task_uuid', $dto->task->uuid);
        }

        if ($dto->description) {
            $query = $query->where('description', $dto->description->value());
        }

        if ($dto->deleted) {
            match ($dto->deleted) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH    => $query = $query->withTrashed(),
                DeletedEnum::ONLY    => $query = $query->onlyTrashed(),
            };
        }

        if ($dto->createdAtFrom) {
            $query = $query->where('created_at', '>=', $dto->createdAtFrom->value());
        }

        if ($dto->createdAtTo) {
            $query = $query->where('created_at', '<=', $dto->createdAtTo->value());
        }

        if ($dto->updatedAtFrom) {
            $query = $query->where('updated_at', '>=', $dto->updatedAtFrom->value());
        }

        if ($dto->updatedAtTo) {
            $query = $query->where('updated_at', '<=', $dto->updatedAtTo->value());
        }

        if ($dto->deletedAtFrom) {
            $query = $query->where('deleted_at', '>=', $dto->deletedAtFrom->value());
        }

        if ($dto->deletedAtTo) {
            $query = $query->where('deleted_at', '<=', $dto->deletedAtTo->value());
        }

        if ($dto->performedAtFrom) {
            $query = $query->where('performed_at', '>=', $dto->performedAtFrom->value());
        }

        if ($dto->performedAtTo) {
            $query = $query->where('performed_at', '<=', $dto->performedAtTo->value());
        }

        if ($dto->orderBy) {
            $query = $query->orderBy($dto->orderByField->value ?? 'updated_at', $dto->orderBy->value);
        }

        if ($dto->limit) {
            $query = $query->limit($dto->limit);
        }

        return $query->get();
    }
}
