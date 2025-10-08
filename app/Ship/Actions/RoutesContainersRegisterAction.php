<?php

namespace App\Ship\Actions;

use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Exceptions\ContainersDirectoryIsEmptyException;
use App\Ship\Exceptions\ContainersDirectoryNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Route;

final readonly class RoutesContainersRegisterAction extends Action
{
    public function run(
        string $channel,
    ): Responder {
        try {
            $containersDirectories = glob(
                pattern: base_path('/app/Containers/') . '*',
                flags: GLOB_ONLYDIR
            );

            if ($containersDirectories === false) {
                throw new ContainersDirectoryNotFoundException();
            }

            if ($containersDirectories === []) {
                throw new ContainersDirectoryIsEmptyException();
            }

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
