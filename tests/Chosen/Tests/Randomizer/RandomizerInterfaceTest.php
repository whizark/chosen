<?php
namespace Chosen\Tests\Randomizer;

use PHPUnit_Framework_TestCase;

/**
 * Class RandomizerInterfaceTest
 *
 * @package Chosen\Tests\Randomizer
 * @author  Whizark
 *
 * @group randomizer
 */
abstract class RandomizerInterfaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Creates a Randomizer.
     *
     * @return \Chosen\Randomizer\RandomizerInterface An instance of a class which implements RandomizerInterface.
     */
    abstract public function createRandomizer();

    public function testGetMinMustReturnIntegerValue()
    {
        $randomizer = $this->createRandomizer();

        $this->assertTrue(is_int($randomizer->getMin()));
    }

    public function testGetMaxMustReturnIntegerValue()
    {
        $randomizer = $this->createRandomizer();

        $this->assertTrue(is_int($randomizer->getMax()));
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsLessThanGetMinValue()
    {
        $randomizer = $this->createRandomizer();

        $randomizer->generate($randomizer->getMin() - 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsLessThanGetMinValue()
    {
        $randomizer = $this->createRandomizer();

        $randomizer->generate($randomizer->getMin(), $randomizer->getMin() - 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsGreaterThanGetMaxValue()
    {
        $randomizer = $this->createRandomizer();

        $randomizer->generate($randomizer->getMax() + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsGreaterThanGetMaxValue()
    {
        $randomizer = $this->createRandomizer();

        $randomizer->generate($randomizer->getMin(), $randomizer->getMax() + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\DomainException
     */
    public function testGenerateMustThrowDomainExceptionWhenTheMinValueIsGreaterThanGetMaxValue()
    {
        $randomizer = $this->createRandomizer();

        $randomizer->generate($randomizer->getMax(), $randomizer->getMin());
    }

    public function testGenerateMustReturnGetMaxValueWhenOnlyTheMinValueIsPassedAndItIsGetMaxValue()
    {
        $randomizer = $this->createRandomizer();

        $result = $randomizer->generate($randomizer->getMax());
        $this->assertSame($randomizer->getMax(), $result);
    }

    public function testGenerateMustReturnGetMinValueWhenOnlyTheMaxValueIsPassedAndItIsGetMinValue()
    {
        $randomizer = $this->createRandomizer();

        $result = $randomizer->generate(null, $randomizer->getMin());

        $this->assertSame($randomizer->getMin(), $result);
    }

    public function testGenerateMustReturnIntegerValue()
    {
        $randomizer = $this->createRandomizer();

        $result = $randomizer->generate($randomizer->getMin(), $randomizer->getMax());

        $this->assertTrue(is_int($result));
    }

    public function testGenerateMustReturnARandomNumberInTheRange()
    {
        $randomizer = $this->createRandomizer();

        $result1 = $randomizer->generate($randomizer->getMin(), $randomizer->getMax());
        $this->assertGreaterThanOrEqual($randomizer->getMin(), $result1);
        $this->assertLessThanOrEqual($randomizer->getMax(), $result1);

        $result2 = $randomizer->generate($randomizer->getMin(), $randomizer->getMax());
        $this->assertGreaterThanOrEqual($randomizer->getMin(), $result2);
        $this->assertLessThanOrEqual($randomizer->getMax(), $result2);

        $this->assertNotEquals($result1, $result2);
    }
}
