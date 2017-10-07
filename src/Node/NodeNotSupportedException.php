<?php

namespace SmartDump\Node;

use RuntimeException;

/**
 * Class NodeNotSupportedException
 *
 * @package SmartDump
 * @subpackage Node
 */
class NodeNotSupportedException extends RuntimeException
{
    /**
     * Create new NodeNotSupportedException for variable
     *
     * @param mixed $variable
     * @return $this
     */
    public static function createFor($variable)
    {
        return new static(
            sprintf(
                'Variable type "%s" is not supported by any known node type factory',
                gettype($variable)
            )
        );
    }
}
