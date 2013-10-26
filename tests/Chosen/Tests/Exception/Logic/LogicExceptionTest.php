<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\LogicException;

/**
 * Class LogicExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class LogicExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\ExceptionInterface
     */
    public function testLogicExceptionMustImplementsExceptionInterface()
    {
        throw new LogicException();
    }

    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testLogicExceptionMustImplementsLogicExceptionInterface()
    {
        throw new LogicException();
    }

    /**
     * @expectedException \LogicException
     */
    public function testLogicExceptionMustExtendsLogicException()
    {
        throw new LogicException();
    }
}
