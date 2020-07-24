<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/4
 * Time: 16:04
 */

namespace App\Console\Makers;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class AntMakerCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:ant {table} {path}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'make file for ant project';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * AntMakerCommand constructor.
     */
    public function __construct()
    {

        $this->filesystem = new Filesystem();
        parent::__construct();
    }

    /**
     * 执行创建
     */
    public function handle()
    {
        //获取路径
        $inputPath = Str::ucfirst(strtolower($this->argument('path')));
        //获取表名
        $tableName = Str::studly($this->argument('table'));

        //模块下
        $basePath = base_path()."/modules/";
        !$this->filesystem->exists($basePath) && $this->filesystem->makeDirectory($basePath);
        $filePath = "{$basePath}/{$inputPath}";
        !$this->filesystem->exists($filePath) && $this->filesystem->makeDirectory($filePath);

        //修改repository配置文件
        config([
            'repository.generator.basePath'          => $filePath,
            'repository.generator.rootNamespace'     => "Modules\\{$inputPath}\\",
            'repository.generator.stubsOverridePath' => __dir__."/..",
            'repository.generator.paths.provider'    => "../../../app/Providers/RepositoryServiceProvider",
        ]);

        //创建repository
        $this->call("make:AntRepository",['name' => $tableName]);
        //创建validator
        $this->call("make:validator", ['name' => $tableName]);
        //创建transformer
        $this->call("make:transformer", ['name' => $tableName]);
        //绑定
        $this->call("make:AntBindings", ['name' => $tableName]);
        //创建Service
        $this->call("make:SunService", ['name' => $tableName, 'path' => $inputPath]);
    }
}