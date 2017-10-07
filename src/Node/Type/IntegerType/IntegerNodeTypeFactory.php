<?php

namespace SmartDump\Node\Type\IntegerType;

use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class IntegerNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class IntegerNodeTypeFactory implements NodeTypeFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_int($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new IntegerNodeType();
        $node->setStringValue((string) $variable);

        return $node;
    }
}
