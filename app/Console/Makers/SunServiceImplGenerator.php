<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/7/23
 * Time: 11:39
 */

namespace App\Console\Makers;


use Prettus\Repository\Generators\Generator;

class SunServiceImplGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'Service/service';

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
        return $this->getBasePath() . '/Service/' . $this->getName() . 'ServiceImpl.php';
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
        return parent::getRootNamespace() . "Service";
    }

    /**
     * Get template replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(),['path' => $this->getOption('defaultPath')]);
    }
}