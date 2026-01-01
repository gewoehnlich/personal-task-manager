<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\CreateBillTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;

final readonly class CreateBillAction extends Action
{
    public function run(
        CreateBillTransporter $transporter,
    ): Responder {
        try {
            $result = Bill::create(
                attributes: $transporter->toArray(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
