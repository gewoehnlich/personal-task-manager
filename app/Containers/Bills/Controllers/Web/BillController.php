<?php

namespace App\Containers\Bills\Controllers\Web;

use App\Containers\Bills\Actions\CreateBillAction;
use App\Containers\Bills\Actions\DeleteBillAction;
use App\Containers\Bills\Actions\UpdateBillAction;
use App\Containers\Bills\Requests\CreateBillRequest;
use App\Containers\Bills\Requests\DeleteBillRequest;
use App\Containers\Bills\Requests\UpdateBillRequest;
use App\Ship\Abstracts\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final readonly class BillController extends WebController
{
    public function create(
        CreateBillRequest $request,
    ): RedirectResponse {
        $this->action(
            CreateBillAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function update(
        UpdateBillRequest $request,
    ): RedirectResponse {
        $this->action(
            UpdateBillAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function delete(
        DeleteBillRequest $request,
    ): RedirectResponse {
        $this->action(
            DeleteBillAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }
}
