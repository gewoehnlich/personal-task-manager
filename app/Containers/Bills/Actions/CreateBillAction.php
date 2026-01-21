<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\CreateBillDto;
use App\Containers\Bills\Models\Bill;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Abstracts\Responders\Responder;

final readonly class CreateBillAction extends Action
{
    public function run(
        CreateBillDto $dto,
    ): Responder {
        try {
            $result = Bill::create(
                attributes: $dto->toArray(),
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
