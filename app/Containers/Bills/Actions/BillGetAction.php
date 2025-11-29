<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\BillGetTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillGetAction extends Action
{
    public function run(
        BillGetTransporter $transporter,
    ): Responder {
        try {
            $bill = Bill::query()
                ->where('task_id', $transporter->taskId)
                ->get();

            if (!isset($bill)) {
                throw new Exception('can\'t find bills.');
            }

            return $this->success(
                data: $bill,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
