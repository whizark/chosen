<?php
namespace Chosen\Randomizer;

use Chosen\Exception\Logic\OutOfRangeException;
use Chosen\Exception\Logic\DomainException;
use Chosen\Randomizer\Source\SourceInterface;

/**
 * Class Randomizer
 *
 * @package Chosen\Randomizer
 * @author  Whizark
 */
class Randomizer implements RandomizerInterface
{
    /**
     * @type int The maximum number this class generates.
     */
    const MAX_VALUE = PHP_INT_MAX;

    /**
     * @var Source\SourceInterface An instance of a class which implements SourceInterface.
     */
    private $source = null;

    /**
     * Constructor.
     *
     * @param SourceInterface $source An instance of a class which implements SourceInterface.
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($min = null, $max = null)
    {
        $min   = ($min !== null) ? (int) $min : 0;
        $max   = ($max !== null) ? (int) $max : static::MAX_VALUE;
        $range = $this->calculateRange($min, $max);

        if ($range === 0) {
            return $min;
        }

        $rnd = $this->generateNumberInRange($range);

        return $min + $rnd;
    }

    /**
     * Calculates the range between a minimum number and maximum number.
     *
     * @param int $min The minimum number of the range.
     * @param int $max The maximum number of the range.
     *
     * @return int The calculated range.
     *
     * @throws \Chosen\Exception\Logic\OutOfRangeException
     * @throws \Chosen\Exception\Logic\DomainException
     */
    private function calculateRange($min, $max)
    {
        if ($min < 0 || $max < 0 || $min > static::MAX_VALUE || $max > static::MAX_VALUE) {
            throw new OutOfRangeException(sprintf('The min/max value must be 0-%d.', static::MAX_VALUE));
        }

        if ($min > $max) {
            throw new DomainException('The min value must be less than or equal to the max value.');
        }

        $range = $max - $min;

        return $range;
    }

    /**
     * Generates a random number in a range.
     *
     * @param int $range The range of the generated number, which is also the maximum value of the generated number.
     *
     * @return int The generated number, which is from 0 through $range.
     */
    private function generateNumberInRange($range)
    {
        // calculate the number of bits required to represent integer number of the range
        $bits = (int) floor(log((float) $range, 2) + 1);

        // calculate the number of bytes based on the number of bits
        $bytes = (int) ceil($bits / 8);

        // generate bit mask
        $mask = ($bits === PHP_INT_SIZE * 8) ? (int) ~(1 << ($bits - 1))
                                             : (int) (1 << $bits) - 1;

        do {
            $rand = hexdec(bin2hex($this->source->generate($bytes)));
            $rand = $rand & $mask;
        } while ($rand > $range);

        return $rand;
    }
}
