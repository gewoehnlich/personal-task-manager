<?php

namespace App\Containers\Auth\Controllers;

use App\Containers\Auth\Requests\CreateUserTokenRequest;
use App\Containers\Auth\Requests\GetUserTokenRequest;
use App\Containers\Auth\Requests\RefreshUserTokenRequest;
use App\Containers\Auth\Requests\RevokeUserTokenRequest;
use App\Ship\Parents\Controllers\WebController;

final class TokenController extends WebController
{
    /**
     * Display a listing of the resource.
     */
    public static function index(
        GetUserTokenRequest $request
    ): JsonResponse {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CreateUserTokenRequest $request
    ): JsonResponse {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public static function update(
        RefreshUserTokenRequest $request,
        int $id,
    ): JsonResponse {

    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy(
        RevokeUserTokenRequest $request,
        int $id,
    ): JsonResponse {
        //
    }
}
