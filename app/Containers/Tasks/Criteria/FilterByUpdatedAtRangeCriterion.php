<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByUpdatedAtRangeCriterion extends Criterion
{
    public function __construct(
        public ?Carbon $updatedAtFrom,
        public ?Carbon $updatedAtTo,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->updatedAtFrom)) {
            $model = $model->where('updated_at', '>=', $this->updatedAtFrom);
        }

        if (isset($this->updatedAtTo)) {
            $model = $model->where('updated_at', '>=', $this->updatedAtTo);
        }

        return $model;
    }
}
