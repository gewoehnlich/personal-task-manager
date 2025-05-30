<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

abstract class ApiController extends Controller
{
    public function sendResponse(
        mixed $result,
        string $message
    ): JsonResponse {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError(
        string $error,
        array $errorMessages = [],
        int $code = 404
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /*public static function create(*/
    /*    Request $request*/
    /*): JsonResource {*/
    /*    //*/
    /*}*/
    /**/
    /*public static function read(*/
    /*    Request $request*/
    /*): JsonResource {*/
    /*    //*/
    /*}*/
    /**/
    /*public static function update(*/
    /*    Request $request*/
    /*): JsonResource {*/
    /*    //*/
    /*}*/
    /**/
    /*public static function delete(*/
    /*    Request $request*/
    /*): JsonResource {*/
    /*    //*/
    /*}*/
}
