<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Criteria\FilterByCreatedAtRangeCriterion;
use App\Containers\Tasks\Criteria\FilterByDeadlineRangeCriterion;
use App\Containers\Tasks\Criteria\FilterByIdCriterion;
use App\Containers\Tasks\Criteria\FilterByLimitCriterion;
use App\Containers\Tasks\Criteria\FilterByOrderByCriterion;
use App\Containers\Tasks\Criteria\FilterByParentIdCriterion;
use App\Containers\Tasks\Criteria\FilterByProjectIdCriterion;
use App\Containers\Tasks\Criteria\FilterByStageCriterion;
use App\Containers\Tasks\Criteria\FilterByUpdatedAtRangeCriterion;
use App\Containers\Tasks\Criteria\FilterByUserIdCriterion;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action as ActionsAction;
use App\Ship\Parents\Exceptions\Exception;

final readonly class IndexTasksAction extends ActionsAction
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        try {
            $this->repository->pushCriteria(
                criteria: new FilterByUserIdCriterion(
                    userId: $transporter->userId,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByIdCriterion(
                    id: $transporter->id,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByStageCriterion(
                    stage: $transporter->stage,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByParentIdCriterion(
                    parentId: $transporter->parentId,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByProjectIdCriterion(
                    projectId: $transporter->projectId,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByCreatedAtRangeCriterion(
                    createdAtFrom: $transporter->createdAtFrom,
                    createdAtTo:   $transporter->createdAtTo,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByUpdatedAtRangeCriterion(
                    updatedAtFrom: $transporter->updatedAtFrom,
                    updatedAtTo:   $transporter->updatedAtTo,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByDeadlineRangeCriterion(
                    deadlineFrom: $transporter->deadlineFrom,
                    deadlineTo:   $transporter->deadlineTo,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByOrderByCriterion(
                    orderBy: $transporter->orderBy,
                    field:   $transporter->orderByField,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByLimitCriterion(
                    limit: $transporter->limit,
                ),
            );

            $result = $this->repository->get();

            return $this->success(
                data: ['result' => $result],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
