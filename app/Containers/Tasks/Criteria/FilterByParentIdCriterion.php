<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByParentIdCriterion extends Criterion
{
    public function __construct(
        public ?int $parentId,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->parentId)) {
            $model = $model->where('parent_id', $this->parentId);
        }

        return $model;
    }
}
