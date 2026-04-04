<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\DeletedEnum;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Support\Collection;

final readonly class IndexTasksAction extends Action
{
    public function run(
        IndexTasksDto $dto,
    ): Collection {
        $query = Task::query();

        $query = $query->where('user_uuid', $dto->user->uuid);

        if ($dto->task) {
            $query = $query->where('uuid', $dto->task->uuid);
        }

        if ($dto->title) {
            $query = $query->where('title', $dto->title?->value());
        }

        if ($dto->description) {
            $query = $query->where('description', $dto->description?->value());
        }

        if ($dto->stage) {
            $query = $query->where('stage', $dto->stage?->value());
        }

        if ($dto->project) {
            $query = $query->where('project_uuid', $dto->project?->uuid);
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

        if ($dto->deadlineFrom) {
            $query = $query->where('deadline', '>=', $dto->deadlineFrom?->value());
        }

        if ($dto->deadlineTo) {
            $query = $query->where('deadline', '<=', $dto->deadlineTo?->value());
        }

        if ($dto->orderBy) {
            $query = $query->orderBy($dto->orderByField?->value ?? 'updated_at', $dto->orderBy->value);
        }

        if ($dto->deleted) {
            match ($dto->deleted) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH    => $query = $query->withTrashed(),
                DeletedEnum::ONLY    => $query = $query->onlyTrashed(),
            };
        }

        if ($dto->limit) {
            $query = $query->limit($dto->limit);
        }

        return $query->get();
    }
}
