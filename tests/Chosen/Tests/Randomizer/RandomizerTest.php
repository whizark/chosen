<?php
namespace Chosen\Tests\Randomizer;

use PHPUnit_Framework_TestCase;
use Mockery;
use Chosen\Randomizer\Randomizer;

/**
 * Class RandomizerTest
 *
 * @package Chosen\Tests\Randomizer
 * @author  Whizark
 *
 * @group randomizer
 */
class RandomizerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetMinMustReturnIntegerValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');

        $randomizer = new Randomizer($source);

        $this->assertTrue(is_int($randomizer->getMin()));
    }

    public function testGetMaxMustReturnIntegerValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');

        $randomizer = new Randomizer($source);

        $this->assertTrue(is_int($randomizer->getMax()));
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsLessThanGetMinValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate($randomizer->getMin() - 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsLessThanGetMinValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate($randomizer->getMin(), $randomizer->getMin() - 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsGreaterThanGetMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate($randomizer->getMax() + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsGreaterThanGetMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate($randomizer->getMin(), $randomizer->getMax() + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\DomainException
     */
    public function testGenerateMustThrowDomainExceptionWhenTheMinValueIsGreaterThanGetMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate($randomizer->getMax(), $randomizer->getMin());
    }

    public function testGenerateMustReturnTheMaxValueWhenOnlyTheMinValueIsPassedAndItIsGetMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result = $randomizer->generate($randomizer->getMax());
        $this->assertSame($randomizer->getMax(), $result);
    }

    public function testGenerateMustReturnTheMinValueWhenOnlyTheMaxValueIsPassedAndItIsGetMinValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result = $randomizer->generate(null, $randomizer->getMin());

        $this->assertSame($randomizer->getMin(), $result);
    }

    public function testGenerateMustReturnARandomNumberInTheRange()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->andReturn('1')
               ->once()
               ->ordered();
        $source->shouldReceive('generate')
               ->andReturn('2')
               ->once()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result1 = $randomizer->generate(1, 255);
        $this->assertGreaterThanOrEqual(1, $result1);
        $this->assertLessThanOrEqual(255, $result1);

        $result2 = $randomizer->generate(1, 255);
        $this->assertGreaterThanOrEqual(1, $result2);
        $this->assertLessThanOrEqual(255, $result2);

        $this->assertNotEquals($result1, $result2);
    }
}
