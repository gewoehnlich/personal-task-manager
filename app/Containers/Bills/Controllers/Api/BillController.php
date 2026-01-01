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
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Controllers\ApiController;

final readonly class BillController extends ApiController
{
    public function index(
        IndexBillsRequest $request,
    ): Responder {
        return $this->action(
            IndexBillsAction::class,
            $request->transported(),
        );
    }

    public function create(
        CreateBillRequest $request,
    ): Responder {
        return $this->action(
            CreateBillAction::class,
            $request->transported(),
        );
    }

    public function update(
        UpdateBillRequest $request,
    ): Responder {
        return $this->action(
            UpdateBillAction::class,
            $request->transported(),
        );
    }

    public function delete(
        DeleteBillRequest $request,
    ): Responder {
        return $this->action(
            DeleteBillAction::class,
            $request->transported(),
        );
    }
}
