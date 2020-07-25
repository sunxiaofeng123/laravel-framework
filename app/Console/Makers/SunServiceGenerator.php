<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/22
 * Time: 17:54
 */

namespace App\Console\Makers;


use Prettus\Repository\Generators\Generator;

/**
 * 生成服务接口文件
 * Class SunServiceGenerator
 * @package App\Console\Makers
 */
class SunServiceGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'Service/interface';

    /**
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'service';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/Service/' . $this->getName() . 'Service.php';
    }

    public function getBasePath()
    {
        return config('repository.generator.basePath', app()->path());
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace() . parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

}