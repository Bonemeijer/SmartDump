<?php

namespace SmartDump\Node\Type\ArrayType;

use SmartDump\Node\NodeFactoryInterface;
use SmartDump\Node\NodeTypeNotSupportedException;
use SmartDump\Node\Type\NodeTypeFactoryInterface;

/**
 * Class ArrayNodeTypeFactory
 *
 * @package SmartDump
 * @subpackage Node
 */
class ArrayNodeTypeFactory implements NodeTypeFactoryInterface
{
    /** @var NodeFactoryInterface */
    protected $itemFactory;

    /**
     * Constructor
     *
     * @param NodeFactoryInterface $itemFactory
     */
    public function __construct(NodeFactoryInterface $itemFactory)
    {
        $this->itemFactory = $itemFactory;
    }

    /**
     * @inheritdoc
     */
    public function supports($variable)
    {
        return is_array($variable);
    }

    /**
     * @inheritdoc
     */
    public function create($variable)
    {
        if (!$this->supports($variable)) {
            throw NodeTypeNotSupportedException::createFor(gettype($variable), $this);
        }

        $node = new ArrayNodeType();

        foreach ($variable as $key => $item) {
            $childNode = $this->itemFactory->create($item);
            $childNode->setName($key);

            $node->addChild($childNode);
        }

        return $node;
    }
}
