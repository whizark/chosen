<?php
namespace Chosen\Tests\Common;

use PHPUnit_Framework_TestCase;

/**
 * Class ToArrayInterfaceTest
 *
 * @package Chosen\Tests\Common
 * @author  Whizark
 *
 * @group common
 */
abstract class ToArrayInterfaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Creates an object which can be represented as an array.
     *
     * @return \Chosen\Common\ToArrayInterface An instance of a class which implements ToArrayInterface.
     */
    abstract public function createToArrayObject();

    public function testToArrayObjectMustReturnAnArray()
    {
        $toArrayObject = $this->createToArrayObject();

        $this->assertTrue(is_array($toArrayObject->toArray()));
    }
}
