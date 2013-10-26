<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\OutOfRangeException;

/**
 * Class OutOfRangeExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class OutOfRangeExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testOutOfRangeExceptionMustImplementsLogicExceptionInterface()
    {
        throw new OutOfRangeException();
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testOutOfRangeExceptionMustExtendsOutOfRangeException()
    {
        throw new OutOfRangeException();
    }
}
