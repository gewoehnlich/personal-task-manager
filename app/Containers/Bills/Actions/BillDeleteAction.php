<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\BillDeleteTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillDeleteAction extends Action
{
    public function run(
        BillDeleteTransporter $transporter,
    ): Responder {
        try {
            $bill = Bill::where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->where('task_id', $transporter->taskId)
                ->first();

            if (!isset($bill)) {
                throw new Exception('can\'t find the bill.');
            }

            $result = $bill->update([
                'deleted' => true,
            ]);

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
