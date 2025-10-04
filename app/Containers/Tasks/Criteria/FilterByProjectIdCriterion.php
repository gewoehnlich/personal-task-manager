<?php

namespace App\Containers\Tasks\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByProjectIdCriterion extends Criterion
{
    public function __construct(
        public ?int $projectId,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        if (isset($this->projectId)) {
            $model = $model->where('project_id', $this->projectId);
        }

        return $model;
    }
}
