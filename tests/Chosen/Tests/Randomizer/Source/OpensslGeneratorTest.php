<?php
namespace Chosen\Tests\Randomizer\Source;

use PHPUnit_Framework_TestCase;
use Chosen\Randomizer\Source\OpensslSource;

/**
 * Class OpensslSourceTest
 *
 * @package Chosen\Tests\Randomizer\Source
 * @author  Whizark
 *
 * @group randomizer
 * @group randomizer-source
 */
class OpensslSourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Chosen\Exception\Logic\OutOfRangeException
     */
    public function testGenerateMustThrowOutOfRangeExceptionWhenANegativeValueIsPassed()
    {
        $source = new OpensslSource();

        $source->generate(-1);
    }

    public function testGenerateMustReturnNoBytesWhen0IsPassed()
    {
        $source = new OpensslSource();

        $result = $source->generate(0);
        $this->assertSame(0, strlen($result));
    }

    public function testGenerateMustReturnCertainLengthRandomBytes()
    {
        $source = new OpensslSource();

        $bits  = (int) floor(log(PHP_INT_MAX, 2) + 1);
        $bytes = (int) ceil($bits / 8);

        $result1 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result1));

        $result2 = $source->generate($bytes);
        $this->assertSame($bytes, strlen($result2));

        $this->assertNotSame($result1, $result2);
    }
}
