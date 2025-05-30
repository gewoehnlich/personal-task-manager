<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Users\UserControllerTest;
use App\Http\Controllers\API\Tasks\TaskController;

/*Route::controller(*/
/*    UserControllerTest::class*/
/*)->group(*/
/*    function () {*/
/*        Route::post(*/
/*            '/register',*/
/*            'register'*/
/*        );*/
/**/
/*        Route::post(*/
/*            '/login',*/
/*            'login'*/
/*        );*/
/*    }*/
/*);*/
/**/
/*Route::post(*/
/*    '/tokens/create',*/
/*    function (*/
/*        Request $request*/
/*    ) {*/
/*        $token = $request->user()->createToken(*/
/*            $request->token_name*/
/*        );*/
/**/
/*        return [*/
/*            'token' => $token->plainTextToken*/
/*        ];*/
/*    }*/
/*);*/

Route::middleware(
    'auth:sanctum'
)->group(
    function () {
        /*Route::resource(*/
        /*    'tasks',*/
        /*    TaskController::class*/
        /*);*/

        Route::post(
            '/tasks/create',
            [
                TaskController::class,
                'create'
            ]
        )->name(
            'tasks.create'
        );

        Route::get(
            '/tasks',
            [
                TaskController::class,
                'read'
            ]
        )->name(
            'tasks.read'
        );

        Route::put(
            '/tasks/edit/{id}',
            [
                TaskController::class,
                'update'
            ]
        )->name(
            'tasks.update'
        );

        Route::delete(
            '/tasks/delete/{id}',
            [
                TaskController::class,
                'delete'
            ]
        )->name(
            'tasks.delete'
        );
    }
);
