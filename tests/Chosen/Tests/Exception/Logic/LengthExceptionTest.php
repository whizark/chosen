<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\LengthException;

/**
 * Class LengthExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class LengthExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testLengthExceptionMustImplementsLogicExceptionInterface()
    {
        throw new LengthException();
    }

    /**
     * @expectedException \LengthException
     */
    public function testLengthExceptionMustExtendsLengthException()
    {
        throw new LengthException();
    }
}
