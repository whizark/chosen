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
        $min   = ($min !== null) ? (int) $min : $this->getMin();
        $max   = ($max !== null) ? (int) $max : $this->getMax();
        $range = $this->calculateRange($min, $max);

        if ($range === 0) {
            return $min;
        }

        $rnd = $this->generateNumberInRange($range);

        return $min + $rnd;
    }

    /**
     * {@inheritdoc}
     */
    public function getMin()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getMax()
    {
        return PHP_INT_MAX;
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
        if ($min < $this->getMin() || $max < $this->getMin() || $min > $this->getMax() || $max > $this->getMax()) {
            throw new OutOfRangeException(sprintf('The min/max value must be %d-%d.', $this->getMin(), $this->getMax()));
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
