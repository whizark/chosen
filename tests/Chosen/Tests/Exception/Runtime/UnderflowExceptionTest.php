<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\UnderflowException;

/**
 * Class UnderflowExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class UnderflowExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testUnderflowExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new UnderflowException();
    }

    /**
     * @expectedException \UnderflowException
     */
    public function testUnderflowExceptionMustExtendsUnderflowException()
    {
        throw new UnderflowException();
    }
}
