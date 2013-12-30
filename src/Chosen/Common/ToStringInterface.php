<?php
namespace Chosen\Common;

/**
 * Interface ToStringInterface
 *
 * @package Chosen\Common
 * @author  Whizark
 *
 * @codeCoverageIgnore
 */
interface ToStringInterface
{
    /**
     * Returns the representation of this object as a string.
     *
     * @return string The representation of the object as a string.
     */
    public function __toString();

    /**
     * Returns the representation of this object as a string.
     *
     * @return string The representation of the object as a string.
     */
    public function toString();
}
