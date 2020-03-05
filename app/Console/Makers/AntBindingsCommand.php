<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/4
 * Time: 20:40
 */

namespace App\Console\Makers;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 生成接口实现类容器绑定
 * Class AntBindingsCommand
 * @package App\Console\Makers
 */
class AntBindingsCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:AntBindings';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new repository.';

    /**
     * Execute the command.
     *
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
        //绑定文件repository
        $antBindingsRepositoryGenerator = new AntBindingsRepositoryGenerator([
            'name' => $this->argument("name"),
        ]);

        $antBindingsRepositoryGenerator->run();
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