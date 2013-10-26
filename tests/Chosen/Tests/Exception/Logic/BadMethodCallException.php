<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\BadMethodCallException;

/**
 * Class BadMethodCallExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class BadMethodCallExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testBadMethodCallExceptionMustImplementsLogicExceptionInterface()
    {
        throw new BadMethodCallException();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testBadMethodCallExceptionMustExtendsBadMethodCallException()
    {
        throw new BadMethodCallException();
    }
}
