<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByIdCriterion extends Criterion
{
    public function __construct(
        public ?int $id,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->id)) {
            $model = $model->where('id', $this->id);
        }

        return $model;
    }
}
