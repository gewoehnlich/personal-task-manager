<?php

namespace App\Ship\Actions;

use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Tasks\DirectoriesContainersGetTask;
use Illuminate\Support\Facades\File;

final readonly class MigrationsContainersGetAction extends Action
{
    public function run(): Responder
    {
        try {
            $containersDirectories = $this->task(
                DirectoriesContainersGetTask::class
            );

            $migrations = [];

            foreach ($containersDirectories as $dir) {
                $dir .= '/Migrations';
                if (! File::exists($dir)) {
                    continue;
                }

                $files = File::allFiles(
                    directory: $dir,
                );

                foreach ($files as $f) {
                    array_push($migrations, $f);
                }
            }

            return $this->success(
                data: [$migrations],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
