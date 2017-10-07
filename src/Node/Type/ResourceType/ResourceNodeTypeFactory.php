<?php

namespace SmartDump\Node\Type\ResourceType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class ResourceNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class ResourceNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_resource($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new ResourceNodeType();
        $node->setStringValue((string) $variable);

        return $node;
    }
}
