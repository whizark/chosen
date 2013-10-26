<?php
namespace Chosen\Tests\Randomizer\Source;

use PHPUnit_Framework_TestCase;
use Chosen\Randomizer\Source\MtRandSource;

/**
 * Class MtRandSourceTest
 *
 * @package Chosen\Tests\Randomizer\Source
 * @author  Whizark
 *
 * @group randomizer
 * @group randomizer-source
 */
class MtRandSourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenANegativeValueIsPassed()
    {
        $source = new MtRandSource();

        $source->generate(-1);
    }

    public function testGenerateMustReturnNoBytesWhen0IsPassed()
    {
        $source = new MtRandSource();

        $result = $source->generate(0);
        $this->assertSame(0, strlen($result));
    }

    public function testGenerateMustReturnCertainLengthRandomBytes()
    {
        $source = new MtRandSource();

        $bits  = (int) floor(log(PHP_INT_MAX, 2) + 1);
        $bytes = (int) ceil($bits / 8);

        $result1 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result1));

        $result2 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result2));

        $this->assertNotSame($result1, $result2);
    }
}
