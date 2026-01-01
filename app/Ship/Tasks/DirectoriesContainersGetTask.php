<?php

namespace App\Ship\Tasks;

use App\Ship\Exceptions\ContainersDirectoryIsEmptyException;
use App\Ship\Exceptions\ContainersDirectoryNotFoundException;
use App\Ship\Abstracts\Tasks\Task;
use Illuminate\Support\Facades\File;

final readonly class DirectoriesContainersGetTask extends Task
{
    public function run(): array
    {
        // File::allFiles
        $containersDirectories = glob(
            pattern: base_path('/app/Containers/') . '*',
            flags: GLOB_ONLYDIR,
        );

        if ($containersDirectories === false) {
            throw new ContainersDirectoryNotFoundException();
        }

        if ($containersDirectories === []) {
            throw new ContainersDirectoryIsEmptyException();
        }

        return $containersDirectories;
    }
}
