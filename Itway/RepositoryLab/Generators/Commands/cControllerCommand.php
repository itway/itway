<?php
namespace RepositoryLab\Repository\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class cControllerCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:cController';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new custom controller.';

    /**
     * @var Collection
     */
    protected $generators = null;

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {

    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of class being generated.', null],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['fillable', null, InputOption::VALUE_OPTIONAL, 'The fillable attributes.', null],
            ['rules', null, InputOption::VALUE_OPTIONAL, 'The rules of validation attributes.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null]
        ];
    }
}