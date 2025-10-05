<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Transporters\BillCreateTransporter;
use App\Containers\Bills\Repositories\BillRepository;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillCreateAction extends Action
{
    public function __construct(
        private readonly BillRepository $repository,
    ) {
        //
    }

    public function run(
        BillCreateTransporter $transporter,
    ): Responder {
        try {
            $result = $this->repository->create(
                attributes: $transporter->toArray()
            );

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
