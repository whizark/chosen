<?php
namespace Chosen\Iterator\Generator;

/**
 * Interface GeneratorInterface
 *
 * @package Chosen\Iterator\Generator
 * @author  Whizark
 *
 * @codeCoverageIgnore
 */
interface GeneratorInterface
{
    /**
     * Creates and returns a new generator-closure.
     *
     * @return \Closure The created generator-closure.
     */
    public function create();
}
