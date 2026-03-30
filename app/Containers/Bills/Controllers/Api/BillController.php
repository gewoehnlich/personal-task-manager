<?php

namespace App\Containers\Bills\Controllers\Api;

use App\Containers\Bills\Actions\CreateBillAction;
use App\Containers\Bills\Actions\DeleteBillAction;
use App\Containers\Bills\Actions\IndexBillsAction;
use App\Containers\Bills\Actions\UpdateBillAction;
use App\Containers\Bills\Requests\CreateBillRequest;
use App\Containers\Bills\Requests\DeleteBillRequest;
use App\Containers\Bills\Requests\IndexBillsRequest;
use App\Containers\Bills\Requests\UpdateBillRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Responses\Response;

final readonly class BillController extends ApiController
{
    public function index(
        IndexBillsRequest $request,
    ): Responder {
        return $this->action(
            IndexBillsAction::class,
            $request->toDto(),
        );
    }

    public function create(
        CreateBillRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: CreateBillAction::class,
                dto: $request->toDto(),
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

    public function update(
        UpdateBillRequest $request,
    ): Responder {
        return $this->action(
            UpdateBillAction::class,
            $request->toDto(),
        );
    }

    public function delete(
        DeleteBillRequest $request,
    ): Responder {
        return $this->action(
            DeleteBillAction::class,
            $request->toDto(),
        );
    }
}
