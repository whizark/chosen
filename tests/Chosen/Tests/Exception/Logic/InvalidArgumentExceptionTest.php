<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\InvalidArgumentException;

/**
 * Class InvalidArgumentExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class InvalidArgumentExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testInvalidArgumentExceptionMustImplementsLogicExceptionInterface()
    {
        throw new InvalidArgumentException();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentExceptionMustExtendsInvalidArgumentException()
    {
        throw new InvalidArgumentException();
    }
}
