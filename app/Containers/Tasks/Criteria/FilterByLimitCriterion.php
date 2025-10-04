<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByLimitCriterion extends Criterion
{
    public function __construct(
        public ?int $limit,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->limit)) {
            $model = $model->limit($this->limit);
        }

        return $model;
    }
}
