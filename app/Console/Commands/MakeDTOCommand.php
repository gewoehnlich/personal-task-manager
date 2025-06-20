<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:dto')]
final class MakeDTOCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {class : The name of the DTO class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DTO class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'DTO';

    /**
     * Execute the console command.
     */
    public function handle(): bool
    {
        try {
            $input  = self::input($this->argument('class'));
            $path   = self::path($input);
            $result = self::file($path);

            $this->info("DTO created: {$result}");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Invalid input for DTO class.");
            return Command::FAILURE;
        }
    }

    private static function input(string $input): string
    {
        $input = self::strip($input);

        if (!self::validateInput($input)) {
            throw new \Exception('not valid input.');
        }

        return $input;
    }

    private static function strip(string $input): string
    {
        $input = trim($input);

        if (str_ends_with($input, '.php')) {
            $input = substr($input, 0, strlen($input) - 4);
        }

        return $input;
    }

    private static function validateInput(string $input): bool
    {
        $pattern = '/^[A-Za-z\/]+$/';
        if (!preg_match($pattern, $input)) {
            return false;
        }

        return true;
    }

    private static function directory(): string
    {
        $directory = app_path('DTO');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        return $directory;
    }

    private static function path(string $input): array // string
    {
        $directory = self::parts(self::directory());

        $input = self::parts($input);

        if (
            count($input) >= count($directory) &&
            self::inputStartsWithDirectoryPath($directory, $input)
        ) {
            $input = self::stripDirectoryPath($directory, $input);
        }

        // $path = self::formPath($directory, $input);
        //
        // if (File::exists($path)) {
        //     throw new \Exception('file already exists');
        // }
        //
        // return $path;

        return array_merge($directory, $input);
    }

    private static function parts(string $path): array | false
    {
        return preg_split('#/#', $path, -1, PREG_SPLIT_NO_EMPTY);
    }

    private static function inputStartsWithDirectoryPath(
        array $directory,
        array $input
    ): bool {
        for ($i = 0; $i < count($directory); ++$i) {
            if ($directory[$i] != $input[$i]) {
                return false;
            }
        }

        return true;
    }

    private static function stripDirectoryPath(
        array $directory,
        array $input
    ): array {
        return array_slice($input, count($directory));
    }

    private static function formPath(array ...$argv): string
    {
        $path = '';

        foreach ($argv as $array) {
            foreach ($array as $folder) {
                $path .= $folder . '/';
            }
        }

        $path = rtrim($path, '/') . '.php';

        return $path;
    }

    private static function file(array $path): bool
    {
        $namespace = self::namespace($path);
        $class = self::class($path);

        $stub = self::stub($namespace, $class);

        File::put($path, $stub);

        return true;
    }

    private static function namespace(array $path): string
    {
        if (count($path) === 0) {
            throw new \Exception('namespace');
        }

        $copy = $path;

        $copy[0] = ucfirst($copy[0]);

        return self::formPath([$copy]);
    }

    private static function class(array $path): string
    {
        return end($path);
    }

    private static function stub(string $namespace, string $class): string
    {
        $stub = File::get(base_path('stubs/dto.base.stub'));

        $stub = str_replace('{{ namespace }}', $namespace, $stub);

        $stub = str_replace('{{ class }}', $class, $stub);

        return $stub;
    }
}
