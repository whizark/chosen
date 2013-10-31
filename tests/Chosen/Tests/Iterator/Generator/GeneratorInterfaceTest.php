<?php
namespace Chosen\Tests\Iterator\Generator;

use PHPUnit_Framework_TestCase;

/**
 * Class GeneratorInterfaceTest
 *
 * @package Chosen\Tests\Iterator\Generator
 * @author  Whizark
 *
 * @group iterator
 * @group iterator-generator
 * @requires PHP 5.5
 */
abstract class GeneratorInterfaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Creates a Generator.
     *
     * @return \Chosen\Iterator\Generator\GeneratorInterface An instance of a class
     *                                                       which implements GeneratorInterface.
     */
    abstract public function createGenerator();

    public function testCreateMustReturnAnInstanceOfClosure()
    {
        $generator = $this->createGenerator();

        $this->assertInstanceOf('Closure', $generator->create());
    }

    public function testCreateMustReturnAnInstanceOfGeneratorClosure()
    {
        $generator = $this->createGenerator();

        $this->assertInstanceOf('Generator', $generator->create()->__invoke());
    }
}
