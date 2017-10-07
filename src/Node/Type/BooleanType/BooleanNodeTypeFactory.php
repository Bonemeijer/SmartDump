<?php

namespace SmartDump\Node\Type\BooleanType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class BooleanNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class BooleanNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_bool($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new BooleanNodeType();
        $node->setStringValue(var_export($variable, true));

        return $node;
    }
}
