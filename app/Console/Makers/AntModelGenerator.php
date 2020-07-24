<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2020/3/6
 * Time: 14:49
 */

namespace App\Console\Makers;


use Illuminate\Support\Str;
use Prettus\Repository\Generators\Generator;
use Prettus\Repository\Generators\Migrations\SchemaParser;

class AntModelGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'model';

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
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'models';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . '.php';
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
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'fillable' => $this->getFillable()
        ]);
    }

    /**
     * get the clomuns
     */
    public function getColumns()
    {
        $filter=['id','created_at','updated_at'];
        $columns = implode(",", array_map(function($item){
            return "{$item->Field}";
        }, array_filter(\DB::select("show full columns from ".Str::snake($this->getName())),function($item)use($filter){
            return !in_array($item->Field,$filter);
        })));

        return $columns;
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        $results = '[' . PHP_EOL;

        foreach (explode(',', $this->getColumns()) as $column => $value) {
            $results .= "\t\t'{$value}'," . PHP_EOL;
        }

        return $results . "\t" . ']';
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->getColumns());
    }
}