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

        $query = $query->where('user_uuid', $dto->userUuid());

        if ($dto->billUuid()) {
            $query = $query->where('uuid', $dto->billUuid());
        }

        if ($dto->taskUuid()) {
            $query = $query->where('task_uuid', $dto->taskUuid());
        }

        if ($dto->description()) {
            $query = $query->where('description', $dto->description());
        }

        if ($dto->deleted()) {
            match ($dto->deleted()) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH    => $query = $query->withTrashed(),
                DeletedEnum::ONLY    => $query = $query->onlyTrashed(),
            };
        }

        if ($dto->createdAtFrom()) {
            $query = $query->where('created_at', '>=', $dto->createdAtFrom());
        }

        if ($dto->createdAtTo()) {
            $query = $query->where('created_at', '<=', $dto->createdAtTo());
        }

        if ($dto->updatedAtFrom()) {
            $query = $query->where('updated_at', '>=', $dto->updatedAtFrom());
        }

        if ($dto->updatedAtTo()) {
            $query = $query->where('updated_at', '<=', $dto->updatedAtTo());
        }

        if ($dto->deletedAtFrom()) {
            $query = $query->where('deleted_at', '>=', $dto->deletedAtFrom());
        }

        if ($dto->deletedAtTo()) {
            $query = $query->where('deleted_at', '<=', $dto->deletedAtTo());
        }

        if ($dto->performedAtFrom()) {
            $query = $query->where('performed_at', '>=', $dto->performedAtFrom());
        }

        if ($dto->performedAtTo()) {
            $query = $query->where('performed_at', '<=', $dto->performedAtTo());
        }

        if ($dto->orderBy()) {
            $query = $query->orderBy($dto->orderByField() ?? 'updated_at', $dto->orderBy());
        }

        if ($dto->limit()) {
            $query = $query->limit($dto->limit());
        }

        return $query->get();
    }
}
