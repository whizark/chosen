<?php
namespace Chosen\Tests\Randomizer;

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
class RandomizerTest extends RandomizerInterfaceTest
{
    /**
     * {@inheritdoc}
     */
    public function createRandomizer()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');

        return new Randomizer($source);
    }

    public function testGenerateMustReturnIntegerValue()
    {
        $source = Mockery::mock('Chosen\\Randomizer\\Source\\SourceInterface');
        $source->shouldReceive('generate')
               ->andReturn('pseudo-random bytes')
               ->once()
               ->ordered();

        $randomizer = new Randomizer($source);

        $result = $randomizer->generate($randomizer->getMin(), $randomizer->getMax());

        $this->assertTrue(is_int($result));
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
