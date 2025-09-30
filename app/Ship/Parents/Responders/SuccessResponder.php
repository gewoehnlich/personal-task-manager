<?php

namespace App\Ship\Parents\Responders;

use App\Ship\Abstracts\Responders\Responder as AbstractResponder;
use App\Ship\Parents\Requests\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponder extends AbstractResponder
{
    public int $status = Response::HTTP_OK;
    public array $data;

    public function toResponse(
        Request $request,
    ): Response {
        return new JsonResponse(
            data: [
                'status' => 'success',
                'data' => $this->data,
            ],
            status: $this->status
        );
    }
}
