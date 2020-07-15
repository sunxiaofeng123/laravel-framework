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
    protected $name = 'make:AntService';

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
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {

    }
}