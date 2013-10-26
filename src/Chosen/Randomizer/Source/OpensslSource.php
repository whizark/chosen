<?php
namespace Chosen\Randomizer\Source;

use Chosen\Exception\Logic\OutOfRangeException;

/**
 * Class OpensslSource
 *
 * @package Chosen\Randomizer\Source
 * @author  Whizark
 */
class OpensslSource implements SourceInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     */
    public function generate($length)
    {
        if ($length < 0) {
            throw new OutOfRangeException('The length must be greater than or equal to 0.');
        }

        if ($length == 0) {
            return '';
        }

        $bytes = openssl_random_pseudo_bytes($length);

        if ($bytes === false) {
            // @codeCoverageIgnoreStart
            throw new RuntimeException();
            // @codeCoverageIgnoreEnd
        }

        return $bytes;
    }
}
