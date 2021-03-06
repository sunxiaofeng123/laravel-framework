<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/4
 * Time: 20:34
 */

namespace App\Console\Makers;


use Prettus\Repository\Generators\Generator;
use Prettus\Repository\Generators\RepositoryEloquentGenerator;
use Prettus\Repository\Generators\RepositoryInterfaceGenerator;

/**
 * Class AntBindingsGenerator
 * @package App\Console\Makers
 */
class AntBindingsRepositoryGenerator extends Generator
{
    /**
     * The placeholder for repository bindings
     *
     * @var string
     */
    public $bindPlaceholder = '//:end-bindings:';
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'bindings/bindings';

    public function run()
    {
        $this->runUse();
        // Add entity repository binding to the repository service provider
        $provider = \File::get($this->getPath());
        $repositoryInterface =  substr($this->getRepository(), strrpos($this->getRepository(),'\\')+1) . "::class";
        $repositoryEloquent  =  substr($this->getEloquentRepository(), strrpos($this->getEloquentRepository(),'\\')+1) . "::class";
        \File::put($this->getPath(), str_replace($this->bindPlaceholder, "\$this->app->singleton({$repositoryInterface}, $repositoryEloquent);" . PHP_EOL . '        ' . $this->bindPlaceholder, $provider));
    }

    public function runUse()
    {
        $provider = \File::get($this->getPath());
        $repositoryInterface = 'use ' . $this->getRepository() . ";";
        $repositoryEloquent  = 'use ' . $this->getEloquentRepository() . ";";
        $placeholder = "//:end-use:";
        $replace = $repositoryInterface.PHP_EOL.$repositoryEloquent.PHP_EOL.$placeholder;
        \File::put($this->getPath(),str_replace($placeholder,$replace,$provider));
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return base_path(). '/app/Providers/RepositoryServiceProvider.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('repository.generator.basePath', app()->path());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'provider';
    }

    /**
     * Gets repository full class name
     *
     * @return string
     */
    public function getRepository()
    {
        $repositoryGenerator = new RepositoryInterfaceGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return str_replace([
                "\\",
                '/'
            ], '\\', $repository) . 'Repository';
    }

    /**
     * Gets eloquent repository full class name
     *
     * @return string
     */
    public function getEloquentRepository()
    {
        $repositoryGenerator = new RepositoryEloquentGenerator([
            'name' => $this->name,
        ]);

        $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();

        return str_replace([
                "\\",
                '/'
            ], '\\', $repository) . 'RepositoryEloquent';
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

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {

        return array_merge(parent::getReplacements(), [
            'repository' => $this->getRepository(),
            'eloquent' => $this->getEloquentRepository(),
            'placeholder' => $this->bindPlaceholder,
        ]);
    }
}