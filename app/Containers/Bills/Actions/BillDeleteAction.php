<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Criteria\FilterByTaskIdCriterion;
use App\Containers\Bills\Transporters\BillDeleteTransporter;
use App\Containers\Bills\Repositories\BillRepository;
use App\Containers\Bills\Criteria\FilterByIdCriterion;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillDeleteAction extends Action
{
    public function __construct(
        private readonly BillRepository $repository,
    ) {
        //
    }

    public function run(
        BillDeleteTransporter $transporter,
    ): Responder {
        try {
            $this->repository->pushCriteria(
                criteria: new FilterByTaskIdCriterion(
                    taskId: $transporter->taskId,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByIdCriterion(
                    id: $transporter->id,
                ),
            );

            $bill = $this->repository->get()->first();

            if (!isset($bill)) {
                throw new Exception('can\'t find the bill.');
            }

            $result = $bill->update([
                'deleted' => true,
            ]);

            return $this->success(
                data: [$result],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
