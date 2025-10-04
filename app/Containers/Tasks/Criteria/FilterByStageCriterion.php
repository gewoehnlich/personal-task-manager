<?php

namespace App\Containers\Tasks\Criteria;

use App\Containers\Tasks\Enums\Stage;
use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByStageCriterion extends Criterion
{
    public function __construct(
        public ?Stage $stage,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->stage)) {
            $model = $model->where('stage', $this->stage);
        }

        return $model;
    }
}
