<?php
namespace Chosen\Randomizer\Source;

use Chosen\Exception\Logic\OutOfRangeException;

/**
 * Class MtRandSource
 *
 * @package Chosen\Randomizer\Source
 * @author  Whizark
 */
class MtRandSource implements SourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate($length)
    {
        if ($length < 0) {
            throw new OutOfRangeException('The length must be greater than or equal to 0.');
        }

        if ($length === 0) {
            return '';
        }

        $bytes = array_map(
            function () {
                return chr(mt_rand(0, 255));
            },
            range(0, $length - 1)
        );
        $bytes = implode($bytes);

        return $bytes;
    }
}
