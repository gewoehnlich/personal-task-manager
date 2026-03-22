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

        $query = $query->where('user_uuid', $dto->userUuid());

        if ($dto->taskUuid() !== null) {
            $query = $query->where('uuid', $dto->taskUuid());
        }

        if ($dto->title() !== null) {
            $query = $query->where('title', $dto->title());
        }

        if ($dto->description() !== null) {
            $query = $query->where('description', $dto->description());
        }

        if ($dto->stage() !== null) {
            $query = $query->where('stage', $dto->stage());
        }

        if ($dto->projectUuid() !== null) {
            $query = $query->where('project_uuid', $dto->projectUuid());
        }

        if ($dto->createdAtFrom() !== null) {
            $query = $query->where('created_at', '>=', $dto->createdAtFrom());
        }

        if ($dto->createdAtTo() !== null) {
            $query = $query->where('created_at', '<=', $dto->createdAtTo());
        }

        if ($dto->updatedAtFrom() !== null) {
            $query = $query->where('updated_at', '>=', $dto->updatedAtFrom());
        }

        if ($dto->updatedAtTo() !== null) {
            $query = $query->where('updated_at', '<=', $dto->updatedAtTo());
        }

        if ($dto->deletedAtFrom() !== null) {
            $query = $query->where('deleted_at', '>=', $dto->deletedAtFrom());
        }

        if ($dto->deletedAtTo() !== null) {
            $query = $query->where('deleted_at', '<=', $dto->deletedAtTo());
        }

        if ($dto->deadlineFrom() !== null) {
            $query = $query->where('deadline', '>=', $dto->deadlineFrom());
        }

        if ($dto->deadlineTo() !== null) {
            $query = $query->where('deadline', '<=', $dto->deadlineTo());
        }

        if ($dto->orderBy() !== null) {
            $query = $query->orderBy($dto->orderByField() ?? 'updated_at', $dto->orderBy());
        }

        if ($dto->deleted()) {
            match ($dto->deleted()) {
                DeletedEnum::WITHOUT => $query,
                DeletedEnum::WITH    => $query = $query->withTrashed(),
                DeletedEnum::ONLY    => $query = $query->onlyTrashed(),
            };
        }

        if ($dto->limit() !== null) {
            $query = $query->limit($dto->limit());
        }

        return $query->get();
    }
}
