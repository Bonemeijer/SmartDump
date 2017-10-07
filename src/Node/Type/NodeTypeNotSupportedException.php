<?php

namespace SmartDump\Node;

use RuntimeException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class NodeTypeNotSupportedException
 *
 * @package SmartDump
 * @subpackage Node
 */
class NodeTypeNotSupportedException extends RuntimeException
{
    /**
     * Create new NodeTypeNotSupportedException for variable
     *
     * @param string $variableType
     * @param NodeTypeFactoryInterface $factory
     * @return $this
     */
    public static function createFor($variableType, NodeTypeFactoryInterface $factory)
    {
        return new static(
            sprintf(
                'Variable type "%s" is not supported by %s',
                $variableType,
                get_class($factory)
            )
        );
    }
}
