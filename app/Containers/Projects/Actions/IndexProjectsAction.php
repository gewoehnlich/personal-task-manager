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

        $query = $query->where('user_uuid', $dto->user->uuid);

        if ($dto->project) {
            $query = $query->where('uuid', $dto->project?->uuid);
        }

        if ($dto->title) {
            $query = $query->where('title', $dto->title?->value());
        }

        if ($dto->description) {
            $query = $query->where('description', $dto->description?->value());
        }

        if ($dto->deleted) {
            match ($dto->deleted) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH    => $query = $query->withTrashed(),
                DeletedEnum::ONLY    => $query = $query->onlyTrashed(),
            };
        }

        if ($dto->createdAtFrom) {
            $query = $query->where('created_at', '>=', $dto->createdAtFrom?->value());
        }

        if ($dto->createdAtTo) {
            $query = $query->where('created_at', '<=', $dto->createdAtTo?->value());
        }

        if ($dto->updatedAtFrom) {
            $query = $query->where('updated_at', '>=', $dto->updatedAtFrom?->value());
        }

        if ($dto->updatedAtTo) {
            $query = $query->where('updated_at', '<=', $dto->updatedAtTo?->value());
        }

        if ($dto->deletedAtFrom) {
            $query = $query->where('deleted_at', '>=', $dto->deletedAtFrom?->value());
        }

        if ($dto->deletedAtTo) {
            $query = $query->where('deleted_at', '<=', $dto->deletedAtTo?->value());
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
