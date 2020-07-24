<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/20
 * Time: 10:07
 */

namespace App\Console\Makers;

use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use Illuminate\Console\Command;
use Modules\Core\Exception\AntException;
use Prettus\Repository\Generators\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;

/**
 * 生成业务文件
 * Class SunServiceCommand
 * @package App\Console\Makers
 */
class SunServiceCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:SunService';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new Service.';

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle()
    {
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * @throws \Prettus\Repository\Generators\FileAlreadyExistsException
     */
    public function fire()
    {
        try {
            (new SunServiceGenerator(['name' => $this->argument('name')]))->run();
            $this->info("Service created successfully.");
        } catch(FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        //创建实体类
        try {
            (new SunServiceImplGenerator([
                'name' => $this->argument('name'),
                'defaultPath' => $this->argument('path'),
            ]))->run();
            $this->info("ServiceImpl created successfully. ");
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . 'already exists!');
        }
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
                'The name of model for which the controller is being generated.',
                null
            ],
            [
                'path',
                InputArgument::REQUIRED,
                'The name of model for which the controller is being generated.',
                null
            ],
        ];
    }
}