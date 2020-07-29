<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/25
 * Time: 10:34
 */

namespace App\Console\Makers;


use Prettus\Repository\Generators\Generator;

class SunBindingsServiceGenerator extends Generator
{
    /**
     * The placeholder for repository bindings
     *
     * @var string
     */
    public $bindPlaceholder = '//:end-bindings:';

    public function run()
    {
        $this->runUse();
        // Add entity repository binding to the repository service provider
        $provider = \File::get($this->getPath());
        $serviceInterface =  substr($this->getService(), strrpos($this->getService(),'\\')+1) . "::class";
        $serviceImpl  =  substr($this->getServiceImpl(), strrpos($this->getServiceImpl(),'\\')+1) . "::class";
        \File::put($this->getPath(), str_replace($this->bindPlaceholder, "\$this->app->singleton({$serviceInterface}, $serviceImpl);" . PHP_EOL . '        ' . $this->bindPlaceholder, $provider));
    }

    public function runUse()
    {
        $provider = \File::get($this->getPath());
        $serviceInterface = 'use ' . $this->getService() . ";";
        $serviceImpl      = 'use ' . $this->getServiceImpl() . ";";
        $placeholder = "//:end-use:";
        $replace = $serviceInterface.PHP_EOL.$serviceImpl.PHP_EOL.$placeholder;
        \File::put($this->getPath(),str_replace($placeholder,$replace,$provider));
    }

    public function getPathConfigNode()
    {
        return 'provider';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return base_path(). '/app/Providers/ServicesServiceProvider.php';
    }

    /**
     * 获取微服务接口
     */
    public function getService()
    {
        $serviceGenerator = new SunServiceGenerator(['name' => $this->getOption('name')]);

        $service = $serviceGenerator->getRootNamespace() . '\\' . $serviceGenerator->getName();

        return str_replace([
                "\\",
                '/'
            ], '\\', $service) . 'Service';
    }

    public function getServiceImpl()
    {
        $serviceImplGenerator = new SunServiceImplGenerator([
            'name' => $this->getOption('name'),
            ]);
        $serviceImpl = $serviceImplGenerator->getRootNamespace()."\\".$serviceImplGenerator->getName();

        return str_replace([
            "\\",
            "/"
        ], '\\', $serviceImpl)."ServiceImpl";
    }
}