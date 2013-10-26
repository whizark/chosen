<?php
namespace Chosen\Tests\Exception\Logic;

use PHPUnit_Framework_TestCase;
use Chosen\Exception\Logic\DomainException;

/**
 * Class DomainExceptionTest
 *
 * @package Chosen\Tests\Exception\Logic
 * @author  Whizark
 *
 * @group exception
 * @group exception-logic
 */
class DomainExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\LogicExceptionInterface
     */
    public function testDomainExceptionMustImplementsLogicExceptionInterface()
    {
        throw new DomainException();
    }

    /**
     * @expectedException \DomainException
     */
    public function testDomainExceptionMustExtendsDomainException()
    {
        throw new DomainException();
    }
}
