<?php
namespace Chosen\Tests\Randomizer\Source;

use PHPUnit_Framework_TestCase;

/**
 * Class SourceInterfaceTest
 *
 * @package Chosen\Tests\Randomizer\Source
 * @author  Whizark
 *
 * @group randomizer
 * @group randomizer-source
 */
abstract class SourceInterfaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Creates a Source.
     *
     * @return \Chosen\Randomizer\Source\SourceInterface An instance of a class which implements SourceInterface.
     */
    abstract public function createSource();

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenANegativeValueIsPassed()
    {
        $source = $this->createSource();

        $source->generate(-1);
    }

    public function testGenerateMustReturnStringValue()
    {
        $source = $this->createSource();

        $result = $source->generate(0);
        $this->assertTrue(is_string($result));
    }

    public function testGenerateMustReturnNoBytesWhen0IsPassed()
    {
        $source = $this->createSource();

        $result = $source->generate(0);
        $this->assertSame(0, strlen($result));
    }

    public function testGenerateMustReturnCertainLengthRandomBytes()
    {
        $source = $this->createSource();

        $bits  = (int) floor(log(PHP_INT_MAX, 2) + 1);
        $bytes = (int) ceil($bits / 8);

        $result1 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result1));

        $result2 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result2));

        $this->assertNotSame($result1, $result2);
    }
}
