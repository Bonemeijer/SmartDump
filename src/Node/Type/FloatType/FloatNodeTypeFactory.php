<?php

namespace SmartDump\Node\Type\FloatType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class FloatNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class FloatNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_float($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new FloatNodeType();
        $node->setStringValue((string) $variable);

        return $node;
    }
}
