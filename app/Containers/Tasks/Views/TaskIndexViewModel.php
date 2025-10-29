<?php

namespace App\Containers\Tasks\Views;

use App\Containers\Tasks\Criteria\FilterByDeletedCriterion;
use App\Containers\Tasks\Criteria\FilterByStageCriterion;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Parents\Views\JsonModel;

final class TaskIndexViewModel extends JsonModel
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function all(): array
    {
        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }

    public function pending(): array
    {
        $this->repository->pushCriteria(
            criteria: new FilterByStageCriterion(
                stage: Stage::PENDING,
            ),
        );

        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }

    public function active(): array
    {
        $this->repository->pushCriteria(
            criteria: new FilterByStageCriterion(
                stage: Stage::ACTIVE,
            ),
        );

        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }

    public function delayed(): array
    {
        $this->repository->pushCriteria(
            criteria: new FilterByStageCriterion(
                stage: Stage::DELAYED,
            ),
        );

        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }

    public function done(): array
    {
        $this->repository->pushCriteria(
            criteria: new FilterByStageCriterion(
                stage: Stage::DONE,
            ),
        );

        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }

    public function deleted(): array
    {
        $this->repository->pushCriteria(
            criteria: new FilterByStageCriterion(
                stage: Stage::DELETED,
            ),
        );

        $result = $this->repository
            ->with('bills')
            ->get();

        return $result->toArray();
    }
}
