<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public function create(
        Request $request
    ): void {
    }

    public function read(
        Request $request
    ): void {
    }

    public function update(
        Request $request
    ): void {
    }

    public function delete(
        Request $request
    ): void {
    }
}
