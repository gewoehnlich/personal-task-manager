<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Enums\DeletedEnum;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Support\Collection;

final readonly class IndexProjectsAction extends Action
{
    public function run(
        IndexProjectsDto $dto,
    ): Collection {
        $query = Project::query();

        $query = $query->where('user_uuid', $dto->userUuid());

        if ($dto->projectUuid()) {
            $query = $query->where('uuid', $dto->projectUuid());
        }

        if ($dto->title()) {
            $query = $query->where('title', $dto->title());
        }

        if ($dto->description()) {
            $query = $query->where('description', $dto->description());
        }

        if ($dto->deleted()) {
            match ($dto->deleted()) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH => $query = $query->withTrashed(),
                DeletedEnum::ONLY => $query = $query->whereNot('deleted_at', null),
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

        if ($dto->orderBy()) {
            $query = $query->orderBy($dto->orderByField() ?? 'updated_at', $dto->orderBy());
        }

        return $query->get();
    }
}
