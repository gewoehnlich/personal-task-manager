<?php

namespace App\Containers\Bills\Controllers\Api;

use App\Containers\Bills\Actions\CreateBillAction;
use App\Containers\Bills\Actions\DeleteBillAction;
use App\Containers\Bills\Actions\IndexBillsAction;
use App\Containers\Bills\Actions\RestoreBillAction;
use App\Containers\Bills\Actions\UpdateBillAction;
use App\Containers\Bills\Requests\CreateBillRequest;
use App\Containers\Bills\Requests\DeleteBillRequest;
use App\Containers\Bills\Requests\IndexBillsRequest;
use App\Containers\Bills\Requests\RestoreBillRequest;
use App\Containers\Bills\Requests\UpdateBillRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Responses\Response;

final readonly class BillController extends ApiController
{
    public function index(
        IndexBillsRequest $request,
    ): Response {
        return $this->response(
            action: IndexBillsAction::class,
            request: $request,
        );
    }

    public function create(
        CreateBillRequest $request,
    ): Response {
        return $this->response(
            action: CreateBillAction::class,
            request: $request,
        );
    }

    public function update(
        UpdateBillRequest $request,
    ): Response {
        return $this->response(
            action: UpdateBillAction::class,
            request: $request,
        );
    }

    public function delete(
        DeleteBillRequest $request,
    ): Response {
        return $this->response(
            action: DeleteBillAction::class,
            request: $request,
        );
    }

    public function restore(
        RestoreBillRequest $request,
    ): Response {
        return $this->response(
            action: RestoreBillAction::class,
            request: $request,
        );
    }
}
