<?php

namespace RepositoryLab\Repository\Generators;

use RepositoryLab\Repository\Generators\Migrations\SchemaParser;

/**
 * Class ModelGenerator
 * @package RepositoryLab\Repository\Generators
 */
class ControllerGenerator extends Generator {

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'controller';

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
        return 'controllers';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */

    public function getBasePath()
    {
        return config('repository.generator.basePath', app_path());
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
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fillable);
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        if ( ! $this->fillable) return '[]';
        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value)
        {
            $results .= "\t\t'{$column}',".PHP_EOL;
        }
        return $results . "\t" . ']';
    }
}