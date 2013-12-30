<?php
namespace Chosen\Tests\Common;

use PHPUnit_Framework_TestCase;

/**
 * Class ToStringInterfaceTest
 *
 * @package Chosen\Tests\Common
 * @author  Whizark
 *
 * @group common
 */
abstract class ToStringInterfaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Creates an object which can be represented as a string.
     *
     * @return \Chosen\Common\ToStringInterface An instance of a class which implements ToStringInterface.
     */
    abstract public function createToStringObject();

    public function testToStringObjectMustReturnAStringWhenToStringMethodIsCalled()
    {
        $toStringObject = $this->createToStringObject();

        $this->assertTrue(is_string($toStringObject->toString()));
    }

    public function testToStringObjectMustReturnAStringWhenTheObjectIsTreatedLikeAString()
    {
        $toStringObject = $this->createToStringObject();

        $this->assertTrue(is_string((string) $toStringObject));
    }
}
