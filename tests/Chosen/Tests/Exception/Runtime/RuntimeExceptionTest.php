<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\RuntimeException;

/**
 * Class RuntimeExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class RuntimeExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\ExceptionInterface
     */
    public function testRuntimeExceptionMustImplementsExceptionInterface()
    {
        throw new RuntimeException();
    }

    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testRuntimeExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new RuntimeException();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRuntimeExceptionMustExtendsRuntimeException()
    {
        throw new RuntimeException();
    }
}
