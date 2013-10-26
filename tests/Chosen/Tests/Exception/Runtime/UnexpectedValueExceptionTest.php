<?php
namespace Chosen\Tests\Exception\Runtime;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Runtime\UnexpectedValueException;

/**
 * Class UnexpectedValueExceptionTest
 *
 * @package Chosen\Tests\Exception\Runtime
 * @author  Whizark
 *
 * @group exception
 * @group exception-runtime
 */
class UnexpectedValueExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Runtime\RuntimeExceptionInterface
     */
    public function testUnexpectedValueExceptionMustImplementsRuntimeExceptionInterface()
    {
        throw new UnexpectedValueException();
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnexpectedValueExceptionMustExtendsUnexpectedValueException()
    {
        throw new UnexpectedValueException();
    }
}
