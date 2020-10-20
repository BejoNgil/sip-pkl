<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Foundation\Console\ModelMakeCommand as ConsoleModelMakeCommand;

class ModelMakeCommand extends ConsoleModelMakeCommand
{
    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceTable($stub, Str::snake(class_basename($name)))
            ->replaceClass($stub, $name);
    }

     /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return parent::getStub();
        }

        return __DIR__ . '/stubs/model.stub';
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(class_basename($this->argument('name')));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return this
     */
    protected function replaceTable(&$stub, $name)
    {
        $stub = str_replace(
            'DummyTable',
            $name,
            $stub
        );

        return $this;
    }
}
