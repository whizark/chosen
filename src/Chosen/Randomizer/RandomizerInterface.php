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
}