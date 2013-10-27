<?php
namespace Chosen\Randomizer;

/**
 * Interface RandomizerInterface
 *
 * @package Chosen\Randomizer
 * @author  Whizark
 *
 * @codeCoverageIgnore
 */
interface RandomizerInterface
{
    /**
     * Generates a random number in a range.
     *
     * @param int $min The minimum number of the range.
     * @param int $max The maximum number of the range.
     *
     * @return int The generated number, which is from $min through $max.
     *
     * @throws \Chosen\Exception\Logic\OutOfRangeException
     */
    public function generate($min, $max);

    /**
     * Returns the largest possible random number.
     *
     * @return int The minimum number that can be returned by a call to generate().
     */
    public function getMin();

    /**
     * Returns the smallest possible random number.
     *
     * @return int The maxmum number that can be returned by a call to generate().
     */
    public function getMax();
}
