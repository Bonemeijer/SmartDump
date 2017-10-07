<?php

namespace SmartDump\Node\Type\StringType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class StringNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class StringNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_string($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new StringNodeType();
        $node->setStringValue($variable);

        return $node;
    }
}
