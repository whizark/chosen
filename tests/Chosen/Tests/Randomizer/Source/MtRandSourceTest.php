<?php
namespace Chosen\Tests\Randomizer\Source;

use Chosen\Randomizer\Source\MtRandSource;

/**
 * Class MtRandSourceTest
 *
 * @package Chosen\Tests\Randomizer\Source
 * @author  Whizark
 *
 * @group randomizer
 * @group randomizer-source
 */
class MtRandSourceTest extends SourceInterfaceTest
{
    /**
     * {@inheritdoc}
     */
    public function createSource()
    {
        return new MtRandSource();
    }
}
