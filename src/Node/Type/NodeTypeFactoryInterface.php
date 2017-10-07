<?php

namespace SmartDump\Node\Type;

use SmartDump\Node\NodeFactoryInterface;

/**
 * Interface NodeTypeFactoryInterface
 *
 * @package SmartDump
 * @subpackage Node
 */
interface NodeTypeFactoryInterface extends NodeFactoryInterface
{
    /**
     * Wether or not a variable is supported by this type factory
     *
     * @param mixed $variable
     * @return bool
     */
    public function supports($variable);
}
