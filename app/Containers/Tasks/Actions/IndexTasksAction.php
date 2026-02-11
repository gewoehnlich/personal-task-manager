<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Support\Collection;

final readonly class IndexTasksAction extends Action
{
    public function run(
        IndexTasksDto $dto,
    ): Collection {
        $query = Task::query()
            ->where('user_uuid', $dto->userUuid());

        if ($dto->uuid() !== null) {
            $query = $query->where('uuid', $dto->uuid());
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

        if ($dto->deadlineFrom() !== null) {
            $query = $query->where('deadline', '>=', $dto->deadlineFrom());
        }

        if ($dto->deadlineTo() !== null) {
            $query = $query->where('deadline', '<=', $dto->deadlineTo());
        }

        if ($dto->orderBy() !== null) {
            $query = $query->orderBy($dto->orderByField() ?? 'updated_at', $dto->orderBy());
        }

        if ($dto->limit() !== null) {
            $query = $query->limit($dto->limit());
        }

        if ($dto->withDeleted() !== true) {
            $query = $query->whereNull('deleted_at');
        }

        return $query->get();
    }
}
