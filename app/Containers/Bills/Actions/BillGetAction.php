<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Criteria\FilterByTaskIdCriterion;
use App\Containers\Bills\Repositories\BillRepository;
use App\Containers\Bills\Transporters\BillGetTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillGetAction extends Action
{
    public function __construct(
        private readonly BillRepository $repository,
    ) {
        //
    }

    public function run(
        BillGetTransporter $transporter,
    ): Responder {
        try {
            // todo: add checking for whether the task is intended for a user
            $this->repository->pushCriteria(
                criteria: new FilterByTaskIdCriterion(
                    taskId: $transporter->taskId,
                ),
            );

            $bills = $this->repository->get();

            if (!isset($bills)) {
                throw new Exception('can\'t find bills.');
            }

            return $this->success(
                data: ['result' => $bills],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
