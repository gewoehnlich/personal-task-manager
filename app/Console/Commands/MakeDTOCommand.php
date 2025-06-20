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
    public function handle()
    {
        $input = $this->argument('input');

        if (!self::validateInput($input)) {
            $this->error("Invalid input for DTO class.");
            return Command::FAILURE;
        }

        $directory = self::directory();
        $path      = self::path($directory, $class);

        if (File::exists($path)) {
            $this->error("DTO already exists at: {$path}");
            return Command::FAILURE;
        }

        $folder    = self::folder();
        $namespace = self::namespace();
        $class     = self::class();
        $stub      = self::stub();

        File::put($path, $stub);
        $this->info("DTO created: {$path}");

        return Command::SUCCESS;
    }

    private static function validateInput(string $input): bool
    {
        $pattern = '/^[A-Za-z\/]+$/';
        if (!preg_match($pattern, $input)) {
            return false;
        }

        return $true;
    }

    private static function directory(): string
    {
        $directory = app_path('DTO');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        return $directory;
    }

    private static function path(string $directory, string $class): string
    {
        $path = $directory . '/' . $class . '.php';

        return $path;
    }

    private static function folder(string $class): string
    {
        $parts = preg_split('#/#', $class, -1, PREG_SPLIT_NO_EMPTY);
    }

    private static function namespace(string $folder): string
    {
        //
    }

    private static function class(): string
    {
        //
    }

    private static function stub(string $namespace, string $class): string
    {
        $stub = File::get(base_path('stubs/dto.base.stub'));
        $stub = str_replace('{{ namespace }}', $namespace, $stub);
        $stub = str_replace('{{ class }}', $class, $stub);

        return $stub;
    }
}
