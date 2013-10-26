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

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsLessThan0()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate(-1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsLessThan0()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate(0, -1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMinValueIsGreaterThanTheMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate(Randomizer::MAX_VALUE + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenTheMaxValueIsGreaterThanTheMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate(0, Randomizer::MAX_VALUE + 1);
    }

    /**
     * @expectedException \Chosen\Exception\Logic\DomainException
     */
    public function testGenerateMustThrowDomainExceptionWhenTheMinValueIsGreaterThanTheMaxValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $randomizer->generate(Randomizer::MAX_VALUE, 0);
    }

    public function testGenerateMustReturnTheMaxValueWhenOnlyTheMinValueIsPassedAndItIsTheMaxValueOfRandomizer()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result = $randomizer->generate(Randomizer::MAX_VALUE);
        $this->assertSame(Randomizer::MAX_VALUE, $result);
    }

    public function testGenerateMustReturnTheMinValueWhenOnlyTheMaxValueIsPassedAndItIs0()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->never()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result = $randomizer->generate(null, 0);

        $this->assertSame(0, $result);
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
