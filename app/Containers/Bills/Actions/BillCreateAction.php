<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\BillCreateTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillCreateAction extends Action
{
    public function run(
        BillCreateTransporter $transporter,
    ): Responder {
        try {
            $result = Bill::create(
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
