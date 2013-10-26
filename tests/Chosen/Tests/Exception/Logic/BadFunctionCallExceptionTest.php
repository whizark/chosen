<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\BadFunctionCallException;

/**
 * Class BadFunctionCallExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class BadFunctionCallExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testBadFunctionCallExceptionMustImplementsLogicExceptionInterface()
    {
        throw new BadFunctionCallException();
    }

    /**
     * @expectedException \BadFunctionCallException
     */
    public function testBadFunctionCallExceptionMustExtendsBadFunctionCallException()
    {
        throw new BadFunctionCallException();
    }
}
