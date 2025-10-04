<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByOrderByCriterion extends Criterion
{
    public function __construct(
        public ?string $orderBy,
        public ?string $field,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->orderBy)) {
            $model = $model->orderBy($this->field ?? 'id', $this->orderBy);
        }

        return $model;
    }
}
