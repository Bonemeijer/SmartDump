<?php

namespace SmartDump\Node;

/**
 * Interface NodeFactoryInterface
 *
 * @package SmartDump
 * @subpackage Node
 */
interface NodeFactoryInterface
{
    /**
     * Create a node from variable
     *
     * @param mixed $variable
     * @return NodeInterface
     */
    public function create($variable);
}
