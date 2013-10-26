<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\OverflowException;

/**
 * Class OverflowExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class OverflowExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testOverflowExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new OverflowException();
    }

    /**
     * @expectedException \OverflowException
     */
    public function testOverflowExceptionMustExtendsOverflowException()
    {
        throw new OverflowException();
    }
}
