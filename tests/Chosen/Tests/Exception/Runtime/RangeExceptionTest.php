<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\RangeException;

/**
 * Class RangeExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class RangeExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testRangeExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new RangeException();
    }

    /**
     * @expectedException \RangeException
     */
    public function testRangeExceptionMustExtendsRangeException()
    {
        throw new RangeException();
    }
}
