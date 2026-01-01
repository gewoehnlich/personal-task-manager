<?php

namespace App\Ship\Actions;

use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Tasks\DirectoriesContainersGetTask;
use Illuminate\Support\Facades\File;

final readonly class MigrationsContainersGetAction extends Action
{
    public function run(): Responder
    {
        try {
            $containersDirectories = $this->task(
                DirectoriesContainersGetTask::class,
            );

            $migrations = [];

            foreach ($containersDirectories as $dir) {
                $dir .= '/Migrations';

                if (
                    ! File::isDirectory(directory: $dir)
                    || File::isEmptyDirectory(directory: $dir)
                ) {
                    continue;
                }

                $files = File::allFiles(
                    directory: $dir,
                );

                foreach ($files as $f) {
                    array_push($migrations, $f->getPathname());
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
