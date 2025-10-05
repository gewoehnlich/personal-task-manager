<?php

namespace App\Containers\Bills\Criteria;

use App\Ship\Parents\Criteria\Criterion;
use Prettus\Repository\Contracts\RepositoryInterface;

final readonly class FilterByUserIdCriterion extends Criterion
{
    public function __construct(
        public int $userId,
    ) {
        //
    }

    public function apply(
        $model,
        RepositoryInterface $repository,
    ) {
        return $model->where('user_id', $this->userId);
    }
}
