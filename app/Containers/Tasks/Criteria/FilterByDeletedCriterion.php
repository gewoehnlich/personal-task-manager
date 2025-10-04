<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByDeletedCriterion extends Criterion
{
    public function __construct(
        public ?bool $deleted,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        return $model->where('deleted', $this->deleted ?? false);
    }
}
