<?php

namespace App\Containers\Projects\Controllers\Web;

use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\ApiController;

final readonly class BillController extends ApiController
{
    public function get(
        BillGetRequest $request,
    ): Responder {
        return $this->action(
            BillGetAction::class,
            $request->transported(),
        );
    }

    public function create(
        BillCreateRequest $request,
    ): Responder {
        return $this->action(
            BillCreateAction::class,
            $request->transported(),
        );
    }

    public function update(
        BillUpdateRequest $request,
    ): Responder {
        return $this->action(
            BillUpdateAction::class,
            $request->transported(),
        );
    }

    public function delete(
        BillDeleteRequest $request,
    ): Responder {
        return $this->action(
            BillDeleteAction::class,
            $request->transported(),
        );
    }
}
