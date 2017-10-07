<?php

namespace SmartDump\Node\Type\NullType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class NullNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class NullNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_null($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new NullNodeType();
        $node->setStringValue('NULL');

        return $node;
    }
}
