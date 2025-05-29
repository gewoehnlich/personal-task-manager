<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    public static function create(
        Request $request
    ): void {
    }

    public static function read(
        Request $request
    ): void {
    }

    public static function update(
        Request $request
    ): void {
    }

    public static function delete(
        Request $request
    ): void {
    }
}
