<?php
namespace Chosen\Randomizer\Source;

/**
 * Interface SourceInterface
 *
 * @package Chosen\Randomizer\Source
 * @author  Whizark
 *
 * @codeCoverageIgnore
 */
interface SourceInterface
{
    /**
     * Generates pseudo-random bytes.
     *
     * @param int $length The length of the generated string.
     *
     * @return string The generated string.
     *
     * @throws \Chosen\Exception\Logic\OutOfRangeException
     */
    public function generate($length);
}
