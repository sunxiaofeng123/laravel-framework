<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/25
 * Time: 10:21
 */

namespace App\Console\Makers;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class SunBindingsServiceCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:bindService';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'bing service.';

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        (new SunBindingsServiceGenerator([
            'name' => $this->argument('name'),
        ]))->run();
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null
            ],
        ];
    }
}