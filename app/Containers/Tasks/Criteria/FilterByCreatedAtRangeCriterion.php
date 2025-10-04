<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByCreatedAtRangeCriterion extends Criterion
{
    public function __construct(
        public ?Carbon $createdAtFrom,
        public ?Carbon $createdAtTo,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->createdAtFrom)) {
            $model = $model->where('created_at', '>=', $this->createdAtFrom);
        }

        if (isset($this->createdAtTo)) {
            $model = $model->where('created_at', '>=', $this->createdAtTo);
        }

        return $model;
    }
}
