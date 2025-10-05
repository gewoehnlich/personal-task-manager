<?php

namespace App\Containers\Bills\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByTaskIdCriterion extends Criterion
{
    public function __construct(
        public int $taskId,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        return $model->where('task_id', $this->taskId);
    }
}
