<?php

namespace App\Containers\Bills\Controllers\Api;

use App\Containers\Bills\Actions\BillCreateAction;
use App\Containers\Bills\Actions\BillGetAction;
use App\Containers\Bills\Requests\BillCreateRequest;
use App\Containers\Bills\Requests\BillGetRequest;
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

    // public function update(
    //     TaskUpdateRequest $request,
    // ): Responder {
    //     return $this->action(
    //         TaskUpdateAction::class,
    //         $request->transported(),
    //     );
    // }
    //
    // public function delete(
    //     TaskDeleteRequest $request,
    // ): Responder {
    //     return $this->action(
    //         TaskDeleteAction::class,
    //         $request->transported(),
    //     );
    // }
}
