<?php

namespace App\Containers\Auth\Controllers;

use App\Containers\Auth\Requests\CreateUserTokenRequest;
use App\Containers\Auth\Requests\GetUserTokenRequest;
use App\Containers\Auth\Requests\RefreshUserTokenRequest;
use App\Containers\Auth\Requests\RevokeUserTokenRequest;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\WebController;

final class TokenController extends WebController
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        GetUserTokenRequest $request,
    ): Responder {
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
        CreateUserTokenRequest $request,
    ): Responder {
        return $this->action(
            CreateUserTokenAction::class,
            $request->transported(),
        );
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
    public function update(
        RefreshUserTokenRequest $request,
        int $id,
    ): Responder {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        RevokeUserTokenRequest $request,
        int $id,
    ): Responder {
        //
    }
}
