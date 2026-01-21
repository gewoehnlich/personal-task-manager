<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;

final readonly class IndexTasksAction extends Action
{
    public function run(
        IndexTasksDto $dto,
    ): Responder {
        $query = Task::query()
            ->where('user_uuid', $dto->userUuid);

        if (isset($dto->uuid)) {
            $query = $query->where('uuid', $dto->uuid);
        }

        if (isset($dto->stage)) {
            $query = $query->where('stage', $dto->stage);
        }

        if (isset($dto->projectUuid)) {
            $query = $query->where('project_uuid', $dto->projectUuid);
        }

        if (isset($dto->createdAtFrom)) {
            $query = $query->where('created_at', '>=', $dto->createdAtFrom);
        }

        if (isset($dto->createdAtTo)) {
            $query = $query->where('created_at', '<=', $dto->createdAtTo);
        }

        if (isset($dto->updatedAtFrom)) {
            $query = $query->where('updated_at', '>=', $dto->updatedAtFrom);
        }

        if (isset($dto->updatedAtTo)) {
            $query = $query->where('updated_at', '<=', $dto->updatedAtTo);
        }

        if (isset($dto->deadlineFrom)) {
            $query = $query->where('deadline', '>=', $dto->deadlineFrom);
        }

        if (isset($dto->deadlineTo)) {
            $query = $query->where('deadline', '<=', $dto->deadlineTo);
        }

        if (isset($dto->orderBy, $dto->orderByField)) {
            $query = $query->orderBy($dto->orderByField ?? 'id', $dto->orderBy);
        }

        if (isset($dto->limit)) {
            $query = $query->limit($dto->limit);
        }

        if ($dto->withDeleted === true) {
            $query = $query->whereNotNull('deleted_at');
        }

        $tasks = $query->get();

        return $this->success(
            data: $tasks,
        );
    }
}
