<?php

namespace App\Ship\Actions;

use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Tasks\DirectoriesContainersGetTask;
use Illuminate\Support\Facades\Route;

final readonly class RoutesContainersRegisterAction extends Action
{
    public function run(
        string $channel,
    ): Responder {
        try {
            $containersDirectories = $this->task(
                DirectoriesContainersGetTask::class,
            );

            foreach ($containersDirectories as $dir) {
                $routePath = $dir . "/Routes/{$channel}.php";

                if (file_exists(filename: $routePath)) {
                    Route::group(
                        attributes: [],
                        routes: $routePath,
                    );
                }
            }

            return $this->success(
                data: ['result' => true],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
