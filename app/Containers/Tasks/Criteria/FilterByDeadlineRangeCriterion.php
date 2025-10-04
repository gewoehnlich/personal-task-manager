<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByDeadlineRangeCriterion extends Criterion
{
    public function __construct(
        public ?Carbon $deadlineFrom,
        public ?Carbon $deadlineTo,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->deadlineFrom)) {
            $model = $model->where('deadline', '>=', $this->deadlineFrom);
        }

        if (isset($this->deadlineTo)) {
            $model = $model->where('deadline', '>=', $this->deadlineTo);
        }

        return $model;
    }
}
