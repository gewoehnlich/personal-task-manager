<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\IndexBillsDto;
use App\Containers\Bills\Models\Bill;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Exception;

final readonly class IndexBillsAction extends Action
{
    public function run(
        IndexBillsDto $dto,
    ): Responder {
        try {
            $bill = Bill::query()
                ->where('task_uuid', $dto->taskUuid)
                ->firstOrFail();

            return $this->success(
                data: $bill,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
