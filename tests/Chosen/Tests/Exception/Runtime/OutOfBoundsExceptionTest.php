<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\OutOfBoundsException;

/**
 * Class OutOfBoundsExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class OutOfBoundsExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testOutOfBoundsExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new OutOfBoundsException();
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testOutOfBoundsExceptionMustExtendsOutOfBoundsException()
    {
        throw new OutOfBoundsException();
    }
}
