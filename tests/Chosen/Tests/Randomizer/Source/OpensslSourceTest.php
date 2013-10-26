<?php
namespace Chosen\Tests\Randomizer\Source;

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
class OpensslSourceTest extends SourceInterfaceTest
{
    /**
     * {@inheritdoc}
     */
    public function createSource()
    {
        return new OpensslSource();
    }
}
